import { StyleSheet, Dimensions } from 'react-native';
import { colors } from '../../../theme/colors';

const { width } = Dimensions.get('window');

export const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: colors.background.primary,
  },
  loadingContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: colors.background.primary,
  },
  errorContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    padding: 32,
    backgroundColor: colors.background.primary,
  },
  errorText: {
    fontSize: 16,
    color: colors.text.error,
    textAlign: 'center',
  },
  featuredImage: {
    width: width,
    height: width * 0.6,
    backgroundColor: colors.background.secondary,
  },
  content: {
    padding: 16,
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    color: colors.text.primary,
    marginBottom: 8,
  },
  date: {
    fontSize: 14,
    color: colors.text.secondary,
    marginBottom: 16,
  },
});
