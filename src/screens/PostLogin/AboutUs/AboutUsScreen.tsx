import React from 'react';
import { View, Text, ScrollView, Image, TouchableOpacity, Linking } from 'react-native';
import { styles } from './Styles';

const AboutUsScreen = () => {
  const handleVisitWebsite = () => {
    Linking.openURL('https://bluestoneapps.com');
  };

  return (
    <ScrollView style={styles.container}>
      <View style={styles.header}>
        <Text style={styles.title}>About Us</Text>
      </View>

      <View style={styles.content}>
        <Image
          source={require('../../../assets/images/logo.png')}
          style={styles.logo}
          resizeMode="contain"
        />

        <Text style={styles.description}>
          Bluestone Apps is a leading mobile app development company specializing in creating
          innovative solutions for businesses. With years of experience in the industry,
          we deliver high-quality applications that help our clients achieve their goals.
        </Text>

        <View style={styles.infoSection}>
          <Text style={styles.sectionTitle}>Our Mission</Text>
          <Text style={styles.sectionText}>
            To provide cutting-edge mobile solutions that transform businesses and enhance
            user experiences through innovative technology and exceptional service.
          </Text>
        </View>

        <View style={styles.infoSection}>
          <Text style={styles.sectionTitle}>Our Vision</Text>
          <Text style={styles.sectionText}>
            To be the leading force in mobile app development, recognized for our innovation,
            quality, and commitment to client success.
          </Text>
        </View>

        <TouchableOpacity style={styles.websiteButton} onPress={handleVisitWebsite}>
          <Text style={styles.websiteButtonText}>Visit Our Website</Text>
        </TouchableOpacity>

        <View style={styles.contactInfo}>
          <Text style={styles.contactTitle}>Contact Us</Text>
          <Text style={styles.contactText}>Email: info@bluestoneapps.com</Text>
          <Text style={styles.contactText}>Phone: (555) 123-4567</Text>
          <Text style={styles.contactText}>Location: New York, NY</Text>
        </View>
      </View>
    </ScrollView>
  );
};

export default AboutUsScreen;
