import React from 'react';
import { NavigationContainer } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import LoginScreen from '../screens/PreLogin/Login/LoginScreen';
import WelcomeScreen from '../screens/WelcomeScreen';
import ForgotPasswordScreen from '../screens/PreLogin/ForgotPassword/ForgotPasswordScreen';
import SignUpScreen from '../screens/PreLogin/SignUp/SignUpScreen';
import VerifyEmailScreen from '../screens/PreLogin/VerifyEmail/VerifyEmailScreen';
import DrawerNavigator from './DrawerNavigator';

const Stack = createNativeStackNavigator();

const AppNavigator = () => {
  return (
    <NavigationContainer>
      <Stack.Navigator
        initialRouteName="Login"
        screenOptions={{
          headerShown: false,
          gestureEnabled: true,
          animation: 'default'
        }}>
        <Stack.Screen
          name="Login"
          component={LoginScreen}
        />
        <Stack.Screen
          name="Welcome"
          component={DrawerNavigator}
        />
        <Stack.Screen
          name="SignUp"
          component={SignUpScreen}
          options={{
            presentation: 'card'
          }}
        />
        <Stack.Screen
          name="ForgotPassword"
          component={ForgotPasswordScreen}
          options={{
            presentation: 'card'
          }}
        />
        <Stack.Screen
          name="VerifyEmail"
          component={VerifyEmailScreen}
          options={{
            presentation: 'card'
          }}
        />
      </Stack.Navigator>
    </NavigationContainer>
  );
};

export default AppNavigator;
