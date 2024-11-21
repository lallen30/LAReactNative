import React from 'react';
import { View, Text, Image, TouchableOpacity, ScrollView } from 'react-native';
import { styles } from './Styles';

const MyProfileScreen = ({ navigation }: any) => {
  const dummyUserData = {
    name: 'John Doe',
    email: 'john.doe@example.com',
    phone: '+1 234 567 8900',
    role: 'Developer',
    joinDate: 'January 2023',
  };

  return (
    <ScrollView style={styles.container}>
      <View style={styles.header}>
        <Image
          source={require('../../../assets/images/profile-pic.svg')}
          style={styles.profileImage}
        />
        <Text style={styles.name}>{dummyUserData.name}</Text>
        <Text style={styles.role}>{dummyUserData.role}</Text>
      </View>

      <View style={styles.infoSection}>
        <View style={styles.infoItem}>
          <Text style={styles.label}>Email</Text>
          <Text style={styles.value}>{dummyUserData.email}</Text>
        </View>

        <View style={styles.infoItem}>
          <Text style={styles.label}>Phone</Text>
          <Text style={styles.value}>{dummyUserData.phone}</Text>
        </View>

        <View style={styles.infoItem}>
          <Text style={styles.label}>Member Since</Text>
          <Text style={styles.value}>{dummyUserData.joinDate}</Text>
        </View>
      </View>

      <TouchableOpacity
        style={styles.editButton}
        onPress={() => navigation.navigate('EditProfile')}
      >
        <Text style={styles.editButtonText}>Edit Profile</Text>
      </TouchableOpacity>
    </ScrollView>
  );
};

export default MyProfileScreen;
