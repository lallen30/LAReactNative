import { StyleSheet, Dimensions } from 'react-native';

const { width } = Dimensions.get('window');

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
    alignItems: 'center',
  },
  logo: {
    width: width * 0.6,
    height: 100,
    marginBottom: 20,
  },
  description: {
    fontSize: 16,
    color: '#666',
    textAlign: 'center',
    lineHeight: 24,
    marginBottom: 30,
  },
  infoSection: {
    width: '100%',
    marginBottom: 30,
  },
  sectionTitle: {
    fontSize: 18,
    fontWeight: 'bold',
    color: '#000',
    marginBottom: 10,
  },
  sectionText: {
    fontSize: 16,
    color: '#666',
    lineHeight: 24,
  },
  webViewContainer: {
    flex: 1,
    width: '100%',
  },
  webView: {
    flex: 1,
    width: '100%',
    backgroundColor: '#ffffff',
  },
  noContent: {
    fontSize: 16,
    color: '#666',
    textAlign: 'center',
    padding: 20,
  },
  websiteButton: {
    backgroundColor: '#007AFF',
    paddingHorizontal: 30,
    paddingVertical: 15,
    borderRadius: 8,
    marginBottom: 30,
  },
  websiteButtonText: {
    color: '#fff',
    fontSize: 16,
    fontWeight: 'bold',
  },
  contactInfo: {
    width: '100%',
    padding: 20,
    backgroundColor: '#f8f9fa',
    borderRadius: 8,
  },
  contactTitle: {
    fontSize: 18,
    fontWeight: 'bold',
    color: '#000',
    marginBottom: 15,
  },
  contactText: {
    fontSize: 16,
    color: '#666',
    marginBottom: 8,
  },
}); 