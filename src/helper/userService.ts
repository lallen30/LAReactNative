import axiosRequest from './axiosRequest';
import { API } from './config';
import AsyncStorage from '@react-native-async-storage/async-storage';

interface UserProfile {
  first_name: string;
  last_name: string;
  email: string;
  phone: string;
  user_avatar?: string;
  access_token: string;
}

class UserService {
  async getProfile(): Promise<UserProfile> {
    try {
      const userToken = await AsyncStorage.getItem('userToken');
      if (!userToken) {
        throw new Error('No auth token found');
      }

      const response = await axiosRequest.post(`${API.ENDPOINTS.MOBILEAPI}/getProfile`, {
        token: userToken,
      });

      console.log('Profile API Response:', response);

      if (response.status === 'success' && response.data) {
        await AsyncStorage.setItem('userData', JSON.stringify(response.data));
        return response.data;
      }

      throw new Error(response.message || 'Failed to get profile');
    } catch (error) {
      console.error('Get profile error:', error);
      throw error;
    }
  }

  async changePassword(oldPassword: string, newPassword: string, confirmPassword: string): Promise<any> {
    try {
      const userDataString = await AsyncStorage.getItem('userData');
      if (!userDataString) {
        throw new Error('User data not found');
      }
      
      const userData = JSON.parse(userDataString);
      const token = userData.loginInfo?.token;
      const email = userData.loginInfo?.email;
      
      if (!token || !email) {
        throw new Error('User information not found');
      }

      const formData = {
        old_password: oldPassword,
        password: newPassword,
        token: token,
        email: email
      };

      const response = await axiosRequest.post(
        `${API.ENDPOINTS.MOBILEAPI}/${API.ENDPOINTS.CHANGE_PASSWORD}`,
        formData,
        {
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          }
        }
      );

      if (response.status === 'success' || response.status === 'ok') {
        const loginResponse = await axiosRequest.post(
          API.ENDPOINTS.LOGIN,
          {
            email: email,
            password: newPassword
          },
          {
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/x-www-form-urlencoded'
            }
          }
        );

        if (loginResponse.loginInfo?.token) {
          await AsyncStorage.setItem('userData', JSON.stringify(loginResponse));
        }
        return response;
      }

      throw new Error(response?.message || 'Failed to change password');
    } catch (error: any) {
      console.error('Change password error:', error);
      if (error.response?.data?.errormsg) {
        throw new Error(error.response.data.errormsg);
      } else if (error.response?.data?.message) {
        throw new Error(error.response.data.message);
      }
      throw error;
    }
  }

  async updateProfile(data: {
    first_name: string;
    last_name: string;
    phone: string;
    profile_img?: any;
  }): Promise<any> {
    try {
      const userDataString = await AsyncStorage.getItem('userData');
      if (!userDataString) {
        throw new Error('User data not found');
      }
      
      const userData = JSON.parse(userDataString);
      const token = userData.loginInfo?.token;
      
      if (!token) {
        throw new Error('User token not found');
      }

      const formData = new FormData();
      formData.append('first_name', data.first_name);
      formData.append('last_name', data.last_name);
      formData.append('phone', data.phone);
      formData.append('token', token);

      if (data.profile_img) {
        formData.append('profile_img', {
          uri: data.profile_img.uri,
          type: data.profile_img.type,
          name: data.profile_img.fileName || 'profile.jpg',
        });
      }

      const response = await axiosRequest.post(API.ENDPOINTS.UPDATE_PROFILE, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });

      if (response.status === 'ok') {
        // Update the stored user data
        const updatedData = {
          ...userData,
          loginInfo: {
            ...userData.loginInfo,
            first_name: data.first_name,
            last_name: data.last_name,
            phone: data.phone,
            name: `${data.first_name} ${data.last_name}`,
            display_name: `${data.first_name} ${data.last_name}`,
            user_avatar: response.profile_img || userData.loginInfo.user_avatar,
          },
        };
        await AsyncStorage.setItem('userData', JSON.stringify(updatedData));
        return response;
      }
      throw new Error(response.message || 'Failed to update profile');
    } catch (error: any) {
      console.error('Update profile error:', error);
      if (error.response?.data?.message) {
        throw new Error(error.response.data.message);
      }
      throw error;
    }
  }
}

export default new UserService();
