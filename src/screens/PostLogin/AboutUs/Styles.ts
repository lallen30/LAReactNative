import { StyleSheet } from 'react-native';

export const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff'
  },
  header: {
    padding: 16,
    borderBottomWidth: 1,
    borderBottomColor: '#eee',
    backgroundColor: '#fff',
    marginBottom: 0
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    color: '#000'
  },
  webViewContainer: {
    flex: 1,
    backgroundColor: '#fff'
  },
  webView: {
    flex: 1,
    backgroundColor: '#fff',
    opacity: 0.99 // Fix for iOS WebView rendering
  },
  noContent: {
    fontSize: 16,
    color: '#666',
    textAlign: 'center',
    marginTop: 20
  }
});
