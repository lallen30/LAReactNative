import axiosRequest from './axiosRequest';
import {API} from './config';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { LoginResponse, AuthError } from './types';

class AuthService {
  async login(email: string, password: string): Promise<LoginResponse> {
    try {
      const response = await axiosRequest.post<any, LoginResponse>(
        API.ENDPOINTS.LOGIN,
        {
          email,
          password,
        }
      );

      if (response.loginInfo?.token) {
        await AsyncStorage.setItem('userToken', response.loginInfo.token);
        await AsyncStorage.setItem('userData', JSON.stringify(response.loginInfo));
      }

      return response;
    } catch (error) {
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
