import React from 'react';
import { View, StyleSheet, Platform, TouchableOpacity } from 'react-native';
import { createDrawerNavigator } from '@react-navigation/drawer';
import { GestureHandlerRootView } from 'react-native-gesture-handler';
import Icon from 'react-native-vector-icons/Ionicons';
import authService from '../helper/authService';
import TabNavigator from './TabNavigator';
import AboutUsScreen from '../screens/PostLogin/AboutUs/AboutUsScreen';
import CalendarScreen from '../screens/PostLogin/Calendar/CalendarScreen';
import EventDetails from '../screens/PostLogin/Calendar/EventDetails';
import MyProfileScreen from '../screens/PostLogin/MyProfile/MyProfileScreen';
import EditProfileScreen from '../screens/PostLogin/EditProfile/EditProfileScreen';
import ChangePasswordScreen from '../screens/PostLogin/ChangePassword/ChangePasswordScreen';
import BluestoneAppsAIScreen from '../screens/PostLogin/BluestoneAppsAI/BluestoneAppsAIScreen';
import HomeScreen from '../screens/PostLogin/Home/HomeScreen';
import ContactScreen from '../screens/PostLogin/Contact/ContactScreen';
import PostsScreen from '../screens/PostLogin/Posts/PostsScreen';
import PostScreen from '../screens/PostLogin/Posts/PostScreen';
import { colors } from '../theme/colors';

const Drawer = createDrawerNavigator();

// Create a wrapper component that combines screen content with TabNavigator
const ScreenWrapper = ({ children, navigation }: { children: React.ReactNode; navigation: any }) => {
  return (
    <View style={styles.container}>
      <View style={styles.contentWrapper}>
        {React.cloneElement(children as React.ReactElement, { navigation })}
      </View>
      <View style={styles.tabNavigator}>
        <TabNavigator />
      </View>
    </View>
  );
};

// Create screen-specific wrappers
const AboutUsWrapper = ({ navigation }: any) => (
  <ScreenWrapper navigation={navigation}>
    <AboutUsScreen />
  </ScreenWrapper>
);

const HomeWrapper = ({ navigation }: any) => (
  <ScreenWrapper navigation={navigation}>
    <HomeScreen />
  </ScreenWrapper>
);

const CalendarWrapper = ({ navigation }: any) => (
  <ScreenWrapper navigation={navigation}>
    <CalendarScreen />
  </ScreenWrapper>
);

const EventDetailsWrapper = ({ navigation }: any) => (
  <ScreenWrapper navigation={navigation}>
    <EventDetails />
  </ScreenWrapper>
);

const ProfileWrapper = ({ navigation }: any) => (
  <ScreenWrapper navigation={navigation}>
    <MyProfileScreen />
  </ScreenWrapper>
);

const EditProfileWrapper = ({ navigation }: any) => (
  <View style={styles.container}>
    <EditProfileScreen navigation={navigation} />
  </View>
);

const ChangePasswordWrapper = ({ navigation }: any) => (
  <View style={styles.container}>
    <ChangePasswordScreen navigation={navigation} />
  </View>
);

const AIWrapper = ({ navigation }: any) => (
  <ScreenWrapper navigation={navigation}>
    <BluestoneAppsAIScreen />
  </ScreenWrapper>
);

function ContactWrapper({ navigation }: any) {
  return <ScreenWrapper navigation={navigation}><ContactScreen /></ScreenWrapper>;
}

const PostWrapper = ({ navigation }: any) => (
  <ScreenWrapper navigation={navigation}>
    <PostScreen />
  </ScreenWrapper>
);

const DrawerNavigator = ({ navigation }: any) => {
  const handleLogout = async () => {
    try {
      await authService.logout();
      navigation.reset({
        index: 0,
        routes: [{ name: 'Login' }],
      });
    } catch (error) {
      console.error('Logout error:', error);
    }
  };

  return (
    <GestureHandlerRootView style={{ flex: 1 }}>
      <Drawer.Navigator
        screenOptions={{
          headerShown: true,
          headerStyle: {
            backgroundColor: colors.background.header,
            elevation: 0,
            shadowOpacity: 0,
            borderBottomWidth: 1,
            borderBottomColor: colors.light,
          },
          headerTintColor: colors.text.header,
          headerTitleStyle: {
            fontWeight: '600',
            color: colors.text.header,
          },
          drawerStyle: {
            backgroundColor: colors.White,
            width: 280,
          },
          drawerActiveBackgroundColor: colors.background.header,
          drawerActiveTintColor: colors.White,
          drawerInactiveTintColor: colors.dark,
        }}
      >
        <Drawer.Screen
          name="Home"
          component={HomeWrapper}
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
        {/* Temporarily hidden Bluestone AI screen */}
        {/* <Drawer.Screen
          name="BluestoneAI"
          component={AIWrapper}
          options={{
            drawerIcon: ({ color }) => (
              <Icon name="bulb-outline" size={24} color={color} />
            ),
            drawerLabel: 'Bluestone AI',
          }}
        /> */}
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
          name="EventDetails"
          component={EventDetailsWrapper}
          options={{
            drawerIcon: ({ color }) => (
              <Icon name="calendar-outline" size={24} color={color} />
            ),
            drawerLabel: () => null,
            drawerItemStyle: { display: 'none' },
            headerLeft: () => (
              <Icon
                name="chevron-back"
                size={28}
                color={colors.text.header}
                style={{ marginLeft: 15 }}
                onPress={() => navigation.navigate('Calendar')}
              />
            ),
          }}
        />
        <Drawer.Screen
          name="About Us"
          component={AboutUsWrapper}
          options={{
            drawerIcon: ({ focused, size }) => (
              <Icon name={focused ? 'information-circle' : 'information-circle-outline'} size={size} color={focused ? '#007AFF' : '#666'} />
            ),
          }}
        />
        <Drawer.Screen
          name="Posts"
          component={PostsScreen}
          options={{
            drawerIcon: ({ color }) => (
              <Icon name="newspaper-outline" size={24} color={color} />
            ),
            drawerLabel: 'Posts',
          }}
        />
        <Drawer.Screen
          name="Post"
          component={PostWrapper}
          options={{
            drawerItemStyle: { display: 'none' },
            headerLeft: () => (
              <Icon
                name="chevron-back"
                size={28}
                color={colors.text.header}
                style={{ marginLeft: 15 }}
                onPress={() => navigation.navigate('Posts')}
              />
            ),
            headerStyle: {
              backgroundColor: colors.background.header,
              elevation: 0,
              shadowOpacity: 0,
              borderBottomWidth: 1,
              borderBottomColor: colors.light,
            },
            headerTitleStyle: {
              color: colors.text.header,
              fontSize: 18,
            },
          }}
        />
        <Drawer.Screen
          name="EditProfile"
          component={EditProfileWrapper}
          options={{
            drawerItemStyle: { display: 'none' },
            headerTitle: 'Edit Profile'
          }}
        />
        <Drawer.Screen
          name="ChangePassword"
          component={ChangePasswordWrapper}
          options={{
            drawerItemStyle: { display: 'none' },
            headerTitle: 'Change Password'
          }}
        />
        <Drawer.Screen
          name="Contact"
          component={ContactWrapper}
          options={{
            drawerIcon: ({ color }) => (
              <Icon name="mail-outline" size={24} color={color} />
            ),
            drawerLabel: 'Contact Us',
            headerTitle: 'Contact Us',
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

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
  },
  contentWrapper: {
    flex: 1,
    marginBottom: Platform.select({
      ios: 80,
      android: 60,
    }),
  },
  content: {
    flex: 1,
  },
  tabNavigator: {
    position: 'absolute',
    bottom: 0,
    left: 0,
    right: 0,
    backgroundColor: '#fff',
    borderTopWidth: 1,
    borderTopColor: '#e0e0e0',
  },
});

const EmptyComponent = () => null;

export default DrawerNavigator; 