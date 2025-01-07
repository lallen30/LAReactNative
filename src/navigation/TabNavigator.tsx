import React from 'react';
import { View } from 'react-native';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import Icon from 'react-native-vector-icons/Ionicons';
import { DrawerActions, useNavigation, useRoute, NavigationProp, ParamListBase } from '@react-navigation/native';
import { colors } from '../theme/colors';

type TabParamList = {
  Home: undefined;
  ContactTab: undefined;
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
          backgroundColor: colors.background.footer,
          borderTopWidth: 1,
          borderTopColor: colors.light,
        },
        tabBarActiveTintColor: colors.secondary,
        tabBarInactiveTintColor: colors.text.footer,
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
        name="ContactTab"
        component={View}
        listeners={{
          tabPress: (e) => {
            e.preventDefault();
            navigation.navigate('Contact');
          },
        }}
        options={{
          tabBarIcon: ({ focused, color }) => (
            <Icon
              name={focused ? 'mail' : 'mail-outline'}
              size={24}
              color={route.name === 'Contact' ? '#007AFF' : '#666'}
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
        listeners={{
          tabPress: (e) => {
            e.preventDefault();
            navigation.dispatch(DrawerActions.openDrawer());
          },
        }}
        options={{
          tabBarIcon: ({ focused, color }) => (
            <Icon
              name={focused ? 'menu' : 'menu-outline'}
              size={24}
              color={color}
            />
          ),
        }}
      />
    </Tab.Navigator>
  );
};

export default TabNavigator;
