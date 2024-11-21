import React from 'react';
import { createDrawerNavigator } from '@react-navigation/drawer';
import { GestureHandlerRootView } from 'react-native-gesture-handler';
import Icon from 'react-native-vector-icons/Ionicons';
import CustomerSupportScreen from '../screens/PostLogin/CustomerSupport/CustomerSupportScreen';
import CalendarScreen from '../screens/PostLogin/Calendar/CalendarScreen';
import PostsScreen from '../screens/PostLogin/Posts/PostsScreen';
import AboutUsScreen from '../screens/PostLogin/AboutUs/AboutUsScreen';

const Drawer = createDrawerNavigator();

const DrawerNavigator = ({ navigation }: any) => {
  const handleLogout = () => {
    navigation.reset({
      index: 0,
      routes: [{ name: 'Login' }],
    });
  };

  return (
    <GestureHandlerRootView style={{ flex: 1 }}>
      <Drawer.Navigator
        screenOptions={{
          headerShown: true,
          drawerStyle: {
            backgroundColor: '#fff',
            width: 280,
          },
          drawerLabelStyle: {
            marginLeft: -20,
          },
        }}
      >
        <Drawer.Screen
          name="CustomerSupport"
          component={CustomerSupportScreen}
          options={{
            drawerIcon: ({ color }) => (
              <Icon name="headset-outline" size={24} color={color} />
            ),
            drawerLabel: 'Customer Support',
          }}
        />
        <Drawer.Screen
          name="Calendar"
          component={CalendarScreen}
          options={{
            drawerIcon: ({ color }) => (
              <Icon name="calendar-outline" size={24} color={color} />
            ),
            drawerLabel: 'Calendar',
          }}
        />
        <Drawer.Screen
          name="Posts"
          component={PostsScreen}
          options={{
            drawerIcon: ({ color }) => (
              <Icon name="document-text-outline" size={24} color={color} />
            ),
            drawerLabel: 'Posts',
          }}
        />
        <Drawer.Screen
          name="AboutUs"
          component={AboutUsScreen}
          options={{
            drawerIcon: ({ color }) => (
              <Icon name="information-circle-outline" size={24} color={color} />
            ),
            drawerLabel: 'About Us',
          }}
        />
        <Drawer.Screen
          name="Logout"
          component={EmptyComponent}
          options={{
            drawerIcon: ({ color }) => (
              <Icon name="log-out-outline" size={24} color={color} />
            ),
          }}
          listeners={{
            drawerItemPress: () => handleLogout(),
          }}
        />
      </Drawer.Navigator>
    </GestureHandlerRootView>
  );
};

const EmptyComponent = () => null;

export default DrawerNavigator; 