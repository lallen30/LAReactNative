import React, { useState, useEffect, useMemo } from 'react';
import { View, Text, ScrollView, TouchableOpacity } from 'react-native';
import { Calendar } from 'react-native-calendars';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { styles } from './Styles';
import axiosRequest from '../../../helper/axiosRequest';
import { API } from '../../../helper/config';
import axios from 'axios';

interface CalendarEvent {
  event_id: string;
  event_title: string;
  event_content: string;
  event_date: string;
  event_to_time: string;
  event_from_time: string;
  event_street_address: string;
  event_apt_suite: string;
  event_city: string;
  event_state: string;
  event_zip: string;
  event_longitude: string | null;
  event_latitude: string | null;
  event_price: string | null;
}

interface MarkedDates {
  [date: string]: {
    marked?: boolean;
    selected?: boolean;
    dotColor?: string;
  };
}

const CalendarScreen = ({ navigation }: any) => {
  const [selectedDate, setSelectedDate] = useState(new Date().toISOString().split('T')[0]);
  const [events, setEvents] = useState<CalendarEvent[]>([]);
  const [markedDates, setMarkedDates] = useState<MarkedDates>({});

  const fetchEvents = async () => {
    try {
      const token = await AsyncStorage.getItem('userToken');
      if (!token) {
        console.error('No token found');
        return;
      }

      console.log('Fetching events with token:', token);
      const response = await axiosRequest.get(API.ENDPOINTS.GET_EVENTS, {
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
        },
        params: { token }
      });
      
      console.log('Events API Response:', response);

      if (response?.status === 'ok' && Array.isArray(response?.listing)) {
        const eventsData = response.listing;
        console.log('Events found:', eventsData);
        setEvents(eventsData);
        
        // Mark dates that have events
        const marked: MarkedDates = {};
        eventsData.forEach((event: CalendarEvent) => {
          const eventDate = event.event_date;
          marked[eventDate] = {
            marked: true,
            dotColor: '#50cebb'
          };
        });
        
        // Also mark the selected date
        if (marked[selectedDate]) {
          marked[selectedDate] = {
            ...marked[selectedDate],
            selected: true
          };
        } else {
          marked[selectedDate] = {
            selected: true
          };
        }
        
        setMarkedDates(marked);
      } else {
        console.warn('Unexpected response format:', response);
        setEvents([]);
        setMarkedDates({
          [selectedDate]: {
            selected: true
          }
        });
      }
    } catch (error) {
      console.error('Error fetching events:', error);
      if (axios.isAxiosError(error)) {
        console.error('Error details:', {
          status: error.response?.status,
          statusText: error.response?.statusText,
          url: error.config?.url,
          method: error.config?.method,
          headers: error.config?.headers,
          params: error.config?.params,
          response: error.response?.data
        });
      }
      setEvents([]);
      setMarkedDates({
        [selectedDate]: {
          selected: true
        }
      });
    }
  };

  useEffect(() => {
    fetchEvents();
  }, []);

  useEffect(() => {
    console.log('Selected date changed to:', selectedDate);
    console.log('Current events:', events);
    console.log('Filtered events:', filteredEvents);
  }, [selectedDate, events, filteredEvents]);

  const onDayPress = (day: any) => {
    console.log('Day pressed - raw data:', day);
    const newSelectedDate = day.dateString;
    console.log('Setting new selected date:', newSelectedDate);
    
    // Update marked dates to include the new selection
    const newMarkedDates = { ...markedDates };
    
    // Remove selected state from previous date
    if (markedDates[selectedDate]) {
      newMarkedDates[selectedDate] = {
        ...markedDates[selectedDate],
        selected: false
      };
      // If the date only had selected: true, remove it entirely
      if (!newMarkedDates[selectedDate].marked) {
        delete newMarkedDates[selectedDate];
      }
    }
    
    // Add selected state to new date
    newMarkedDates[newSelectedDate] = {
      ...markedDates[newSelectedDate],
      selected: true
    };
    
    // Update states
    setMarkedDates(newMarkedDates);
    setSelectedDate(newSelectedDate);
  };

  // Filter events for selected date
  const filteredEvents = useMemo(() => {
    console.log('Filtering events for date:', selectedDate);
    return events.filter(event => event.event_date === selectedDate);
  }, [events, selectedDate]);

  const formatDate = (dateString: string) => {
    console.log('Formatting date:', dateString);
    try {
      const [year, month, day] = dateString.split('-').map(num => parseInt(num, 10));
      const date = new Date(year, month - 1, day); // month is 0-based in Date constructor
      console.log('Constructed date:', date);
      return date.toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      });
    } catch (error) {
      console.error('Error formatting date:', error);
      return dateString;
    }
  };

  const formattedSelectedDate = useMemo(() => {
    return formatDate(selectedDate);
  }, [selectedDate]);

  useEffect(() => {
    console.log('Selected date state updated:', selectedDate);
    console.log('Formatted date:', formatDate(selectedDate));
  }, [selectedDate]);

  const formatTime = (timeStr: string) => {
    const [hours, minutes] = timeStr.split(':');
    const date = new Date();
    date.setHours(parseInt(hours, 10));
    date.setMinutes(parseInt(minutes, 10));
    return date.toLocaleTimeString('en-US', {
      hour: 'numeric',
      minute: '2-digit',
      hour12: true
    });
  };

  return (
    <View style={styles.container}>
      <Calendar
        style={styles.calendar}
        markedDates={markedDates}
        onDayPress={onDayPress}
        theme={{
          selectedDayBackgroundColor: '#50cebb',
          todayTextColor: '#50cebb',
          arrowColor: '#50cebb',
        }}
      />
      <View style={[styles.sectionHeader, { padding: 20, marginVertical: 15 }]}>
        <Text style={[styles.sectionTitle, { fontSize: 20, fontWeight: '600' }]}>
          Events for {formatDate(selectedDate)}
        </Text>
      </View>
      <ScrollView style={styles.eventsContainer}>
        {filteredEvents.length > 0 ? (
          filteredEvents.map((event) => (
            <TouchableOpacity
              key={event.event_id}
              style={styles.eventCard}
              onPress={() => navigation.navigate('EventDetails', { event })}
            >
              <Text style={styles.eventTitle}>{event.event_title}</Text>
              <Text style={styles.eventTime}>
                {formatTime(event.event_from_time)} - {formatTime(event.event_to_time)}
              </Text>
              <Text style={styles.eventLocation}>
                {event.event_street_address}
                {event.event_apt_suite ? `, ${event.event_apt_suite}` : ''}
                {event.event_city ? `, ${event.event_city}` : ''}
                {event.event_state ? `, ${event.event_state}` : ''}
                {event.event_zip ? ` ${event.event_zip}` : ''}
              </Text>
            </TouchableOpacity>
          ))
        ) : (
          <Text style={styles.noEventsText}>No events on this date</Text>
        )}
      </ScrollView>
    </View>
  );
};

export default CalendarScreen;
