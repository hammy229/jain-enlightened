import React from 'react';
import {
  Text,
  StyleSheet,
  TouchableOpacity,
  ImageBackground,
} from 'react-native';
import { fonts } from '../../assets/fonts';
import { colors } from '../../assets/styles/colors';
import { useNavigation } from '@react-navigation/native';

const OpportunityCard = ({ internshipDetails }) => {
  const navigation = useNavigation();
  return (
    <ImageBackground
      source={require('../../assets/images/opportunityBg.png')}
      style={styles.card}
      imageStyle={{ borderRadius: 10 }}>
      <Text style={styles.heading}>{internshipDetails?.heading}</Text>
      <Text style={styles.description}>{internshipDetails?.sub_heading}</Text>
      <Text style={styles.subText}>{internshipDetails?.description}</Text>

      <TouchableOpacity
        onPress={() => navigation.navigate('Internship')}
        style={styles.button}>
        <Text style={styles.buttonText}>Discover More</Text>
      </TouchableOpacity>
    </ImageBackground>
  );
};

const styles = StyleSheet.create({
  card: {
    padding: 25,
    borderRadius: 10,
    overflow: 'hidden',
    justifyContent: 'center',
    alignItems: 'center',
    marginVertical: 20,
  },
  heading: {
    fontSize: 12,
    fontFamily: fonts.JakartaMedium,
    textAlign: 'center',
    marginBottom: 10,
  },
  description: {
    fontSize: 16,
    textAlign: 'center',
    marginBottom: 15,
    fontFamily: fonts.JakartaExtraBold,
    color: colors.blue,
  },
  subText: {
    fontSize: 12,
    textAlign: 'center',
    marginBottom: 20,
    fontFamily: fonts.JakartaMedium,
  },
  button: {
    backgroundColor: '#F5A623',
    paddingVertical: 10,
    paddingHorizontal: 25,
    borderRadius: 5,
  },
  buttonText: {
    color: 'white',
    fontSize: 14,
    fontFamily: fonts.JakartaBold,
  },
});

export default OpportunityCard;
