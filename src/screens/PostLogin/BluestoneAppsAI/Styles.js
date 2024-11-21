import { StyleSheet } from 'react-native';

export const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
  },
  header: {
    padding: 20,
    backgroundColor: '#f8f9fa',
    alignItems: 'center',
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    color: '#000',
  },
  content: {
    padding: 20,
  },
  description: {
    fontSize: 16,
    color: '#666',
    marginBottom: 20,
    textAlign: 'center',
  },
  featuresContainer: {
    gap: 15,
  },
  featureCard: {
    backgroundColor: '#f8f9fa',
    padding: 20,
    borderRadius: 10,
    marginBottom: 15,
  },
  featureTitle: {
    fontSize: 18,
    fontWeight: 'bold',
    color: '#000',
    marginBottom: 5,
  },
  featureDescription: {
    fontSize: 14,
    color: '#666',
  },
}); 