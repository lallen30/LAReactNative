import React, { useState, useEffect } from 'react';
import {
  View,
  Text,
  TextInput,
  TouchableOpacity,
  Alert,
  Image,
} from 'react-native';
import AsyncStorage from '@react-native-async-storage/async-storage';
import Icon from 'react-native-vector-icons/Ionicons';
import { styles } from './Styles';
import authService from '../../../helper/authService';
import { AuthError, LoginResponse } from '../../../helper/types';
import { StackNavigationProp } from '@react-navigation/stack';

type RootStackParamList = {
  Login: undefined;
  Welcome: undefined;
  ForgotPassword: undefined;
  SignUp: undefined;
};

type LoginScreenNavigationProp = StackNavigationProp<RootStackParamList, 'Login'>;

interface Props {
  navigation: LoginScreenNavigationProp;
}

const LoginScreen: React.FC<Props> = ({ navigation }) => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [rememberMe, setRememberMe] = useState(false);
  const [showPassword, setShowPassword] = useState(false);

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
      const trimmedEmail = email.trim();
      if (!trimmedEmail || !password) {
        Alert.alert('Error', 'Please enter both email and password');
        return;
      }

      // Basic email validation
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(trimmedEmail)) {
        Alert.alert('Error', 'Please enter a valid email address');
        return;
      }

      console.log('Attempting login with:', { email: trimmedEmail });

      const response = await authService.login(trimmedEmail, password);
      
      if (response.loginInfo?.token) {
        await AsyncStorage.setItem('rememberMe', rememberMe.toString());
        console.log('Login successful, navigating to Welcome screen');
        navigation.replace('Welcome');
      } else {
        console.log('No token in response:', response);
        Alert.alert('Error', 'Invalid response from server');
      }
    } catch (error) {
      const authError = error as AuthError;
      console.error('Login error:', authError);
      Alert.alert(
        'Error',
        authError.response?.data?.message?.replace(/<[^>]*>/g, '') || 
        authError.response?.data?.errormsg || 
        'An error occurred during login. Please try again.'
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
        placeholderTextColor="#2c3e50"
        value={email}
        onChangeText={(text) => setEmail(text.toLowerCase().trim())}
        keyboardType="email-address"
        autoCapitalize="none"
        autoCorrect={false}
        spellCheck={false}
      />
      <View style={styles.passwordContainer}>
        <TextInput
          style={[styles.input, { marginBottom: 0, color: '#2c3e50' }]}
          placeholder="Password"
          placeholderTextColor="#2c3e50"
          value={password}
          onChangeText={setPassword}
          secureTextEntry={!showPassword}
          autoCapitalize="none"
          autoCorrect={false}
        />
        <TouchableOpacity
          style={styles.eyeIcon}
          onPress={() => setShowPassword(!showPassword)}
        >
          <Icon
            name={showPassword ? 'eye-off-outline' : 'eye-outline'}
            size={24}
            color="#2c3e50"
          />
        </TouchableOpacity>
      </View>
      <View style={styles.checkboxContainer}>
        <TouchableOpacity
          style={[styles.customCheckbox, rememberMe && styles.customCheckboxChecked]}
          onPress={() => setRememberMe(!rememberMe)}
        >
          {rememberMe && (
            <Icon name="checkmark" size={16} color="#fff" />
          )}
        </TouchableOpacity>
        <Text style={styles.checkboxLabel}>Remember me</Text>
      </View>
      <TouchableOpacity style={styles.button} onPress={handleLogin}>
        <Text style={styles.buttonText}>Login</Text>
      </TouchableOpacity>
      <View style={styles.linkContainer}>
        <TouchableOpacity onPress={() => navigation.navigate('ForgotPassword')}>
          <Text style={styles.link}>Forgot Password?</Text>
        </TouchableOpacity>
        <TouchableOpacity onPress={() => navigation.navigate('SignUp')}>
          <Text style={styles.link}>Sign Up</Text>
        </TouchableOpacity>
      </View>
    </View>
  );
};

export default LoginScreen;
