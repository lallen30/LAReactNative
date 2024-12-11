import React, { useState } from 'react';
import { View, Text, TouchableOpacity, ScrollView } from 'react-native';
import { styles } from './Styles';

const CalendarScreen = ({ navigation }: any) => {
  const [selectedDate, setSelectedDate] = useState(new Date());

  const dummyEvents = [
    { id: 1, title: 'Team Meeting', time: '10:00 AM', date: '2023-11-20' },
    { id: 2, title: 'Project Review', time: '2:00 PM', date: '2023-11-20' },
    { id: 3, title: 'Client Call', time: '11:00 AM', date: '2023-11-21' },
  ];

  return (
    <ScrollView style={styles.container}>
      <View style={styles.header}>
        <Text style={styles.title}>Calendar</Text>
        <Text style={styles.subtitle}>{selectedDate.toDateString()}</Text>
      </View>

      <View style={styles.eventsContainer}>
        <Text style={styles.sectionTitle}>Upcoming Events</Text>
        {dummyEvents.map(event => (
          <TouchableOpacity key={event.id} style={styles.eventCard}>
            <Text style={styles.eventTitle}>{event.title}</Text>
            <Text style={styles.eventTime}>{event.time}</Text>
            <Text style={styles.eventDate}>{event.date}</Text>
          </TouchableOpacity>
        ))}
      </View>

      <TouchableOpacity style={styles.addButton}>
        <Text style={styles.addButtonText}>Add New Event</Text>
      </TouchableOpacity>
    </ScrollView>
  );
};

export default CalendarScreen;
