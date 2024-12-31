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
import Icon from 'react-native-vector-icons/Ionicons';
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
        placeholderTextColor="#999"
        value={email}
        onChangeText={(text) => setEmail(text.toLowerCase().trim())}
        keyboardType="email-address"
        autoCapitalize="none"
        autoCorrect={false}
        spellCheck={false}
      />
      <View style={styles.passwordContainer}>
        <TextInput
          style={styles.input}
          placeholder="Password"
          placeholderTextColor="#999"
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
            color="#666"
          />
        </TouchableOpacity>
      </View>
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
