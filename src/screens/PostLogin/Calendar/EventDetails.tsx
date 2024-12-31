import React from 'react';
import { View, Text, ScrollView, StyleSheet } from 'react-native';
import { useNavigation, useRoute } from '@react-navigation/native';

const EventDetails = () => {
  const navigation = useNavigation();
  const route = useRoute();
  const event = route.params?.event;

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

  const formatDate = (dateString: string) => {
    const [year, month, day] = dateString.split('-').map(num => parseInt(num, 10));
    const date = new Date(year, month - 1, day);
    return date.toLocaleDateString('en-US', {
      weekday: 'long',
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    });
  };

  return (
    <View style={styles.container}>
      <ScrollView style={styles.content}>
        <Text style={styles.title}>{event.event_title}</Text>
        <Text style={styles.date}>{formatDate(event.event_date)}</Text>
        <Text style={styles.time}>
          {formatTime(event.event_from_time)} - {formatTime(event.event_to_time)}
        </Text>
        
        <View style={styles.section}>
          <Text style={styles.sectionTitle}>Location</Text>
          <Text style={styles.location}>
            {event.event_street_address}
            {event.event_apt_suite ? `\n${event.event_apt_suite}` : ''}
            {'\n'}
            {[
              event.event_city,
              event.event_state,
              event.event_zip
            ].filter(Boolean).join(', ')}
          </Text>
        </View>

        {event.event_content && (
          <View style={styles.section}>
            <Text style={styles.sectionTitle}>Description</Text>
            <Text style={styles.description}>{event.event_content}</Text>
          </View>
        )}

        {event.event_price && (
          <View style={styles.section}>
            <Text style={styles.sectionTitle}>Price</Text>
            <Text style={styles.price}>${event.event_price}</Text>
          </View>
        )}
      </ScrollView>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
  },
  content: {
    flex: 1,
    padding: 20,
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    color: '#2c3e50',
    marginBottom: 10,
  },
  date: {
    fontSize: 18,
    color: '#50cebb',
    marginBottom: 5,
  },
  time: {
    fontSize: 18,
    color: '#50cebb',
    marginBottom: 20,
  },
  section: {
    marginBottom: 25,
  },
  sectionTitle: {
    fontSize: 18,
    fontWeight: '600',
    color: '#2c3e50',
    marginBottom: 10,
  },
  location: {
    fontSize: 16,
    color: '#6c757d',
    lineHeight: 24,
  },
  description: {
    fontSize: 16,
    color: '#6c757d',
    lineHeight: 24,
  },
  price: {
    fontSize: 18,
    color: '#50cebb',
    fontWeight: '500',
  },
});

export default EventDetails;
