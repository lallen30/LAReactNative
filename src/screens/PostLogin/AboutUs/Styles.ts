import { StyleSheet } from 'react-native';
import { colors } from '../../../theme/colors';

export const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: colors.background.primary,
  },
  header: {
    padding: 16,
    borderBottomWidth: 1,
    borderBottomColor: '#eee',
    backgroundColor: colors.background.header,
    marginBottom: 0
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    color: colors.text.header,
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
