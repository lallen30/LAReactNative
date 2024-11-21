import React from 'react';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import Icon from 'react-native-vector-icons/Ionicons';
import MyProfileScreen from '../screens/PostLogin/MyProfile/MyProfileScreen';
import EditProfileScreen from '../screens/PostLogin/MyProfile/EditProfileScreen';
import BluestoneAppsAIScreen from '../screens/PostLogin/BluestoneAppsAI/BluestoneAppsAIScreen';
import CustomerSupportScreen from '../screens/PostLogin/CustomerSupport/CustomerSupportScreen';
import CalendarScreen from '../screens/PostLogin/Calendar/CalendarScreen';
import DrawerNavigator from './DrawerNavigator';

const Tab = createBottomTabNavigator();
const ProfileStack = createNativeStackNavigator();

const ProfileStackNavigator = () => {
  return (
    <ProfileStack.Navigator screenOptions={{ headerShown: false }}>
      <ProfileStack.Screen name="ProfileMain" component={MyProfileScreen} />
      <ProfileStack.Screen name="EditProfile" component={EditProfileScreen} />
    </ProfileStack.Navigator>
  );
};

const TabNavigator = () => {
  return (
    <Tab.Navigator
      screenOptions={{
        headerShown: false,
        tabBarShowLabel: false,
        tabBarStyle: {
          backgroundColor: '#fff',
          borderTopWidth: 1,
          borderTopColor: '#e0e0e0',
          height: 60,
        },
      }}
    >
      <Tab.Screen
        name="MyProfile"
        component={ProfileStackNavigator}
        options={{
          tabBarIcon: ({ focused }) => (
            <Icon
              name={focused ? 'person' : 'person-outline'}
              size={24}
              color={focused ? '#007AFF' : '#666'}
            />
          ),
        }}
      />
      <Tab.Screen
        name="BluestoneAppsAI"
        component={BluestoneAppsAIScreen}
        options={{
          tabBarIcon: ({ focused }) => (
            <Icon
              name={focused ? 'bulb' : 'bulb-outline'}
              size={24}
              color={focused ? '#007AFF' : '#666'}
            />
          ),
        }}
      />
      <Tab.Screen
        name="CustomerSupport"
        component={CustomerSupportScreen}
        options={{
          tabBarIcon: ({ focused }) => (
            <Icon
              name={focused ? 'headset' : 'headset-outline'}
              size={24}
              color={focused ? '#007AFF' : '#666'}
            />
          ),
        }}
      />
      <Tab.Screen
        name="Calendar"
        component={CalendarScreen}
        options={{
          tabBarIcon: ({ focused }) => (
            <Icon
              name={focused ? 'calendar' : 'calendar-outline'}
              size={24}
              color={focused ? '#007AFF' : '#666'}
            />
          ),
        }}
      />
      <Tab.Screen
        name="Menu"
        component={DrawerNavigator}
        options={{
          tabBarIcon: ({ focused }) => (
            <Icon
              name={focused ? 'menu' : 'menu-outline'}
              size={24}
              color={focused ? '#007AFF' : '#666'}
            />
          ),
        }}
      />
    </Tab.Navigator>
  );
};

export default TabNavigator;
