import React, { useState } from 'react';
import {
  View,
  Text,
  TextInput,
  TouchableOpacity,
  ScrollView,
  Alert,
} from 'react-native';
import { styles } from './Styles';

const ChangePasswordScreen = ({ navigation }: any) => {
  const [formData, setFormData] = useState({
    currentPassword: '',
    newPassword: '',
    confirmPassword: '',
  });

  const handleChangePassword = () => {
    if (formData.newPassword !== formData.confirmPassword) {
      Alert.alert('Error', 'New passwords do not match');
      return;
    }

    // TODO: Implement API call to change password
    Alert.alert('Success', 'Password changed successfully');
    navigation.goBack();
  };

  return (
    <ScrollView style={styles.container}>
      <View style={styles.header}>
        <Text style={styles.title}>Change Password</Text>
      </View>

      <View style={styles.formContainer}>
        <View style={styles.inputGroup}>
          <Text style={styles.label}>Current Password</Text>
          <TextInput
            style={styles.input}
            value={formData.currentPassword}
            onChangeText={(text) => setFormData({ ...formData, currentPassword: text })}
            placeholder="Enter current password"
            secureTextEntry
          />
        </View>

        <View style={styles.inputGroup}>
          <Text style={styles.label}>New Password</Text>
          <TextInput
            style={styles.input}
            value={formData.newPassword}
            onChangeText={(text) => setFormData({ ...formData, newPassword: text })}
            placeholder="Enter new password"
            secureTextEntry
          />
        </View>

        <View style={styles.inputGroup}>
          <Text style={styles.label}>Confirm New Password</Text>
          <TextInput
            style={styles.input}
            value={formData.confirmPassword}
            onChangeText={(text) => setFormData({ ...formData, confirmPassword: text })}
            placeholder="Confirm new password"
            secureTextEntry
          />
        </View>
      </View>

      <TouchableOpacity style={styles.saveButton} onPress={handleChangePassword}>
        <Text style={styles.saveButtonText}>Change Password</Text>
      </TouchableOpacity>
    </ScrollView>
  );
};

export default ChangePasswordScreen;
