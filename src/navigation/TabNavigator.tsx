import React from 'react';
import { View } from 'react-native';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import Icon from 'react-native-vector-icons/Ionicons';
import { DrawerActions, useNavigation, useRoute, NavigationProp, ParamListBase } from '@react-navigation/native';

type TabParamList = {
  Home: undefined;
  AITab: undefined;
  BluestoneAI: undefined;
  ProfileTab: undefined;
  CalendarTab: undefined;
  Menu: undefined;
};

const Tab = createBottomTabNavigator<TabParamList>();

const TabNavigator = () => {
  const navigation = useNavigation<NavigationProp<TabParamList>>();
  const route = useRoute();

  return (
    <Tab.Navigator
      screenOptions={{
        headerShown: false,
        tabBarShowLabel: false,
        tabBarStyle: {
          backgroundColor: '#fff',
          borderTopWidth: 1,
          borderTopColor: '#e9ecef',
        },
        tabBarActiveTintColor: '#007AFF',
        tabBarInactiveTintColor: '#666',
      }}
    >
      <Tab.Screen
        name="ProfileTab"
        component={View}
        listeners={{
          tabPress: (e) => {
            e.preventDefault();
            navigation.navigate('MyProfile');
          },
        }}
        options={{
          tabBarIcon: ({ focused, color }) => (
            <Icon
              name={focused ? 'person' : 'person-outline'}
              size={24}
              color={route.name === 'MyProfile' ? '#007AFF' : '#666'}
            />
          ),
        }}
      />
      <Tab.Screen
        name="AITab"
        component={View}
        listeners={{
          tabPress: (e) => {
            e.preventDefault();
            navigation.navigate('BluestoneAI');
          },
        }}
        options={{
          tabBarIcon: ({ focused, color }) => (
            <Icon
              name={focused ? 'bulb' : 'bulb-outline'}
              size={24}
              color={route.name === 'BluestoneAI' ? '#007AFF' : '#666'}
            />
          ),
        }}
      />
      <Tab.Screen
        name="HomeTab"
        component={View}
        listeners={{
          tabPress: (e) => {
            e.preventDefault();
            navigation.navigate('Home');
          },
        }}
        options={{
          tabBarIcon: ({ focused, color }) => (
            <Icon
              name={focused ? 'home' : 'home-outline'}
              size={24}
              color={route.name === 'Home' ? '#007AFF' : '#666'}
            />
          ),
        }}
      />
      <Tab.Screen
        name="CalendarTab"
        component={View}
        listeners={{
          tabPress: (e) => {
            e.preventDefault();
            navigation.navigate('Calendar');
          },
        }}
        options={{
          tabBarIcon: ({ focused, color }) => (
            <Icon
              name={focused ? 'calendar' : 'calendar-outline'}
              size={24}
              color={route.name === 'Calendar' ? '#007AFF' : '#666'}
            />
          ),
        }}
      />
      <Tab.Screen
        name="Menu"
        component={View}
        options={{
          tabBarIcon: ({ focused, color }) => (
            <Icon
              name={focused ? 'menu' : 'menu-outline'}
              size={24}
              color={color}
            />
          ),
        }}
        listeners={{
          tabPress: (e) => {
            e.preventDefault();
            navigation.dispatch(DrawerActions.toggleDrawer());
          },
        }}
      />
    </Tab.Navigator>
  );
};

export default TabNavigator;
