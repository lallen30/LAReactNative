import React, { useState, useEffect } from 'react';
import {
  View,
  Text,
  TextInput,
  TouchableOpacity,
  Alert,
  Image,
} from 'react-native';
import CheckBox from '@react-native-community/checkbox';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { styles } from './Styles';
import authService from '../../../helper/authService';
import { AuthError, LoginResponse } from '../../../helper/types';
import { StackNavigationProp } from '@react-navigation/stack';

type RootStackParamList = {
  Login: undefined;
  Welcome: undefined;
};

type LoginScreenNavigationProp = StackNavigationProp<RootStackParamList, 'Login'>;

interface Props {
  navigation: LoginScreenNavigationProp;
}

const LoginScreen: React.FC<Props> = ({ navigation }) => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [rememberMe, setRememberMe] = useState(false);

  useEffect(() => {
    checkPreviousLogin();
  }, []);

  const checkPreviousLogin = async () => {
    try {
      const rememberMeStatus = await AsyncStorage.getItem('rememberMe');
      if (rememberMeStatus === 'true') {
        const userToken = await AsyncStorage.getItem('userToken');
        if (userToken) {
          navigation.replace('Welcome');
        }
      }
    } catch (error) {
      console.error('Error checking previous login:', error);
    }
  };

  const handleLogin = async () => {
    try {
      console.log('Attempting login with:', { email });

      const response = await authService.login(email, password);
      
      // Now TypeScript knows response is of type LoginResponse
      if (response.loginInfo?.token) {
        await AsyncStorage.setItem('rememberMe', rememberMe.toString());
        console.log('Login successful, navigating to Welcome screen');
        navigation.replace('Welcome');
      } else {
        console.log('No token in response');
        Alert.alert('Error', 'Invalid response from server');
      }
    } catch (error) {
      const authError = error as AuthError;
      console.error('Login error:', authError);
      Alert.alert(
        'Error',
        authError.response?.data?.message?.replace(/<[^>]*>/g, '') || 'An error occurred during login. Please try again.'
      );
    }
  };

  return (
    <View style={styles.container}>
      <View style={styles.logoContainer}>
        <Image
          source={require('../../../assets/images/logo.png')}
          style={styles.logo}
          resizeMode="contain"
        />
      </View>
      <Text style={styles.title}>Login</Text>
      <TextInput
        style={styles.input}
        placeholder="Email"
        placeholderTextColor="#999"
        value={email}
        onChangeText={setEmail}
        keyboardType="email-address"
        autoCapitalize="none"
        autoCorrect={false}
      />
      <TextInput
        style={styles.input}
        placeholder="Password"
        placeholderTextColor="#999"
        value={password}
        onChangeText={setPassword}
        secureTextEntry
        autoCapitalize="none"
        autoCorrect={false}
      />
      <View style={styles.checkboxContainer}>
        <CheckBox
          value={rememberMe}
          onValueChange={setRememberMe}
          tintColors={{ true: '#007AFF', false: '#999' }}
        />
        <Text style={styles.checkboxLabel}>Remember me</Text>
      </View>
      <TouchableOpacity style={styles.button} onPress={handleLogin}>
        <Text style={styles.buttonText}>Login</Text>
      </TouchableOpacity>
    </View>
  );
};

export default LoginScreen;
