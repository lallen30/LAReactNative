import { StyleSheet } from 'react-native';

export const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
  },
  calendar: {
    marginBottom: 0,
  },
  contentContainer: {
    flex: 1,
    backgroundColor: '#fff',
  },
  sectionHeader: {
    backgroundColor: '#f8f9fa',
    borderBottomWidth: 1,
    borderTopWidth: 1,
    borderColor: '#e9ecef',
  },
  sectionTitle: {
    color: '#2c3e50',
    textAlign: 'center',
  },
  titleContainer: {
    backgroundColor: '#fff',
    margin: 15,
    borderRadius: 8,
    shadowColor: '#000',
    shadowOffset: {
      width: 0,
      height: 1,
    },
    shadowOpacity: 0.1,
    shadowRadius: 2,
    elevation: 2,
  },
  eventsContainer: {
    flex: 1,
    paddingHorizontal: 15,
  },
  eventCard: {
    backgroundColor: '#fff',
    padding: 15,
    marginBottom: 12,
    borderRadius: 10,
    shadowColor: '#000',
    shadowOffset: {
      width: 0,
      height: 2,
    },
    shadowOpacity: 0.1,
    shadowRadius: 3,
    elevation: 3,
    borderWidth: 1,
    borderColor: '#f0f0f0',
  },
  eventTitle: {
    fontSize: 16,
    fontWeight: 'bold',
    color: '#2c3e50',
    marginBottom: 8,
  },
  eventTime: {
    fontSize: 14,
    color: '#50cebb',
    marginBottom: 8,
    fontWeight: '500',
  },
  eventLocation: {
    fontSize: 14,
    color: '#6c757d',
    lineHeight: 20,
  },
  noEventsText: {
    textAlign: 'center',
    color: '#6c757d',
    fontSize: 15,
    paddingVertical: 20,
    fontStyle: 'italic',
  },
});
