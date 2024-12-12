import axios from 'axios';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { API } from './config';

const axiosRequest = axios.create({
  baseURL: API.BASE_URL,
  headers: {
    'Content-Type': 'application/json',
  },
});

// Request interceptor
axiosRequest.interceptors.request.use(
  async (config) => {
    const token = await AsyncStorage.getItem('userToken');
    if (token && config.headers) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

// Response interceptor
axiosRequest.interceptors.response.use(
  (response) => {
    return response.data;
  },
  async (error) => {
    if (error?.response?.status === 401) {
      await AsyncStorage.removeItem('userToken');
      await AsyncStorage.removeItem('userData');
      await AsyncStorage.removeItem('rememberMe');
    }
    return Promise.reject(error);
  }
);

export default axiosRequest;
