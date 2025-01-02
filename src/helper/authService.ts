import axiosRequest from './axiosRequest';
import {API} from './config';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { LoginResponse, AuthError } from './types';

class AuthService {
  async login(email: string, password: string): Promise<LoginResponse> {
    try {
      console.log('Attempting login with:', { email });

      const data = {
        email: email.trim(),
        password: password
      };

      console.log('Making request to:', API.ENDPOINTS.LOGIN, 'with data:', data);

      const response = await axiosRequest.post<LoginResponse>(
        API.ENDPOINTS.LOGIN,
        data,
        {
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
          }
        }
      );

      console.log('Login response:', response);

      if (response?.loginInfo?.token) {
        await AsyncStorage.setItem('userToken', response.loginInfo.token);
        await AsyncStorage.setItem('userData', JSON.stringify(response));
      }

      return response;
    } catch (error) {
      console.error('Login error:', error);
      throw error as AuthError;
    }
  }

  async logout(): Promise<void> {
    try {
      await AsyncStorage.removeItem('userToken');
      await AsyncStorage.removeItem('userData');
      await AsyncStorage.removeItem('rememberMe');
    } catch (error) {
      console.error('Logout error:', error);
      throw error as AuthError;
    }
  }

  // Add other auth-related methods here
}

export default new AuthService();
