import { StyleSheet, Dimensions } from 'react-native';

const { width } = Dimensions.get('window');

export const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
  },
  logoContainer: {
    alignItems: 'center',
    marginTop: 40,
    marginBottom: 20,
  },
  logo: {
    width: width * 0.6,
    height: 100,
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    marginBottom: 20,
    textAlign: 'center',
    color: '#000',
  },
  input: {
    height: 50,
    borderWidth: 1,
    borderColor: '#ddd',
    borderRadius: 8,
    paddingHorizontal: 15,
    marginHorizontal: 20,
    marginBottom: 15,
    fontSize: 16,
    color: '#000',
  },
  inputError: {
    borderColor: '#ff0000',
  },
  errorText: {
    color: '#ff0000',
    fontSize: 12,
    marginHorizontal: 20,
    marginTop: -10,
    marginBottom: 10,
  },
  termsContainer: {
    flexDirection: 'row',
    alignItems: 'center',
    marginHorizontal: 20,
    marginBottom: 20,
  },
  termsText: {
    marginLeft: 8,
    fontSize: 14,
    color: '#333',
  },
  button: {
    backgroundColor: '#007AFF',
    height: 50,
    borderRadius: 8,
    justifyContent: 'center',
    alignItems: 'center',
    marginHorizontal: 20,
    marginBottom: 15,
  },
  buttonText: {
    color: '#fff',
    fontSize: 16,
    fontWeight: 'bold',
  },
  loginLink: {
    alignItems: 'center',
    marginBottom: 30,
  },
  loginLinkText: {
    color: '#007AFF',
    fontSize: 16,
  },
});
