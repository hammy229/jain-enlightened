import React from 'react';
import { View, Text, Image, StyleSheet, Dimensions } from 'react-native';
import { fonts } from '../../assets/fonts';
import { colors } from '../../assets/styles/colors';
import { globalStyles } from '../../assets/styles/globalStyles';
import HTML from 'react-native-render-html';

interface TestimonialCardProps {
  name: string;
  location: string;
  testimonial: string;
  profileImage: string;
}

const TestimonialCard: React.FC<TestimonialCardProps> = ({
  name,
  location,
  testimonial,
  profileImage,
}) => {
  return (
    <View style={[globalStyles.padHorizontal, { flex: 1 }]}>
      <View style={styles.card}>
        <View style={styles.header}>
          {/* <Image source={{ uri: profileImage }} style={styles.avatar} /> */}
          <View style={styles.userInfo}>
            <Text style={styles.name} numberOfLines={1} ellipsizeMode="tail">
              {name}
            </Text>
            <Text
              style={styles.location}
              numberOfLines={1}
              ellipsizeMode="tail">
              {location}
            </Text>
          </View>
        </View>

        <Text style={styles.testimonial}>{testimonial}</Text>
        {/* <HTML source={{ html: testimonial }} /> */}

        <View style={styles.navigation}>
          {/* <FontAwesome name="chevron-left" size={24} color="black" />
            <FontAwesome name="chevron-right" size={24} color="black" /> */}
        </View>
      </View>
    </View>
  );
};

const styles = StyleSheet.create({
  card: {
    width: '100%',
    paddingVertical: 20,
    paddingHorizontal: 28,
    borderRadius: 10,
    backgroundColor: '#fff',
    shadowColor: '#000',
    shadowOpacity: 0.1,
    shadowRadius: 10,
    elevation: 5,
    alignItems: 'flex-start',
    // justifyContent: 'center',
    marginVertical: 10,
    minHeight: 200,
  },
  header: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'flex-start',
    marginBottom: 10,
    paddingBottom: 10,
    borderBottomColor: '#D9D9D9',
    borderBottomWidth: 1,
    width: '100%',
  },
  avatar: {
    width: 45,
    height: 45,
    objectFit: 'contain',
    borderRadius: 25,
    marginRight: 10,
    alignSelf: 'flex-start',
  },
  userInfo: {
    flex: 1,
    justifyContent: 'center',
  },
  name: {
    fontSize: 13,
    fontFamily: fonts.JakartaBold,
    lineHeight: 18,
    color: colors.black,
  },
  location: {
    fontSize: 12,
    color: colors.grey1,
    fontFamily: fonts.JakartaRegular,
    lineHeight: 16,
  },
  testimonial: {
    fontSize: 14,
    fontFamily: fonts.JakartaRegular,
    color: colors.black,
    marginTop: 10,
    textAlign: 'justify',
  },
  navigation: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    width: '100%',
    marginTop: 20,
  },
});

export default TestimonialCard;
