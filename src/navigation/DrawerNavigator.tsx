import React from 'react';
import { createDrawerNavigator } from '@react-navigation/drawer';
import { GestureHandlerRootView } from 'react-native-gesture-handler';
import Icon from 'react-native-vector-icons/Ionicons';
import TabNavigator from './TabNavigator';
import AboutUsScreen from '../screens/PostLogin/AboutUs/AboutUsScreen';

const Drawer = createDrawerNavigator();

// Create wrapper components that include TabNavigator
const CustomerSupportWrapper = () => <TabNavigator initialRoute="SupportTab" />;
const CalendarWrapper = () => <TabNavigator initialRoute="CalendarTab" />;
const ProfileWrapper = () => <TabNavigator initialRoute="ProfileTab" />;
const AIWrapper = () => <TabNavigator initialRoute="AITab" />;
const AboutUsWithTabs = () => {
  return (
    <>
      <AboutUsScreen />
      <TabNavigator />
    </>
  );
};

// Update the wrapper
const AboutUsWrapper = () => <AboutUsWithTabs />;

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
            marginLeft: -10,
            fontSize: 16,
          },
          drawerItemStyle: {
            paddingLeft: 8,
          },
        }}
      >
        <Drawer.Screen
          name="Home"
          component={TabNavigator}
          options={{
            drawerIcon: ({ color }) => (
              <Icon name="home-outline" size={24} color={color} />
            ),
          }}
        />
        <Drawer.Screen
          name="MyProfile"
          component={ProfileWrapper}
          options={{
            drawerIcon: ({ color }) => (
              <Icon name="person-outline" size={24} color={color} />
            ),
            drawerLabel: 'My Profile',
          }}
        />
        <Drawer.Screen
          name="BluestoneAI"
          component={AIWrapper}
          options={{
            drawerIcon: ({ color }) => (
              <Icon name="bulb-outline" size={24} color={color} />
            ),
            drawerLabel: 'Bluestone AI',
          }}
        />
        <Drawer.Screen
          name="CustomerSupport"
          component={CustomerSupportWrapper}
          options={{
            drawerIcon: ({ color }) => (
              <Icon name="headset-outline" size={24} color={color} />
            ),
            drawerLabel: 'Customer Support',
          }}
        />
        <Drawer.Screen
          name="Calendar"
          component={CalendarWrapper}
          options={{
            drawerIcon: ({ color }) => (
              <Icon name="calendar-outline" size={24} color={color} />
            ),
            drawerLabel: 'Calendar',
          }}
        />
        <Drawer.Screen
          name="AboutUs"
          component={AboutUsWrapper}
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