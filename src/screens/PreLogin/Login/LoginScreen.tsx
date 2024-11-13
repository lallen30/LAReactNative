import React, { useState, useEffect } from 'react';
import {
  View,
  Text,
  TextInput,
  TouchableOpacity,
  Alert,
  Image,
  Dimensions,
} from 'react-native';
import CheckBox from '@react-native-community/checkbox';
import axios from 'axios';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { styles } from './Styles';

const { width } = Dimensions.get('window');

const LoginScreen = ({ navigation }: any) => {
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
      console.log('Attempting login with:', { email, password });

      const response = await axios({
        method: 'post',
        url: 'https://wordpress.betaplanets.com/wp-json/jwt-auth/v1/token',
        data: {
          email: email,
          password: password
        },
        headers: {
          'Content-Type': 'application/json',
        },
      });

      console.log('API Response:', response.data);

      if (response.data.loginInfo?.token) {
        console.log('Login successful, saving token and user data');
        await AsyncStorage.setItem('userToken', response.data.loginInfo.token);
        await AsyncStorage.setItem('userData', JSON.stringify(response.data.loginInfo));
        await AsyncStorage.setItem('rememberMe', rememberMe.toString());
        console.log('Navigating to Welcome screen');
        navigation.replace('Welcome');
      } else {
        console.log('No token in response');
        Alert.alert('Error', 'Invalid response from server');
      }
    } catch (error: any) {
      console.error('Login error:', error);
      if (error.response) {
        console.error('Error response:', error.response.data);
        console.error('Error status:', error.response.status);
        console.error('Error headers:', error.response.headers);
      } else if (error.request) {
        console.error('Error request:', error.request);
      } else {
        console.error('Error message:', error.message);
      }
      Alert.alert(
        'Error',
        error.response?.data?.message?.replace(/<[^>]*>/g, '') || 'An error occurred during login. Please try again.'
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
