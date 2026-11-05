import { View, Text, ScrollView, Image, StyleSheet } from 'react-native';
import React, { useEffect, useState } from 'react';
import LayoutWrapper from '../layouts/LayoutWrapper';
import SecondaryPageHeader from '../components/SecondaryPageHeader';
import { globalStyles } from '../assets/styles/globalStyles';
import { TermsLogo } from '../assets/images';
import { fonts } from '../assets/fonts';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { fetchTermsCondition } from '../api/api';
import Loader from '../components/Loader';
import HTML from 'react-native-render-html';

const TermsScreen = () => {
  const [terms, setTerms] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const getTerms = async () => {
      try {
        const url = await AsyncStorage.getItem('baseUrl');

        if (url) {
          const response = await fetchTermsCondition(url);
          setTerms(response);
        } else {
          console.log('Base URL not found in AsyncStorage');
        }
      } catch (error) {
        console.log('Error fetching podcasts: ', error);
      } finally {
        setLoading(false);
      }
    };

    getTerms();
  }, []);

  if (loading) {
    return <Loader />;
  }
  return (
    <LayoutWrapper>
      {/* Terms & Conditions Header */}
      <SecondaryPageHeader title="Terms & Conditions" />

      {/* Terms */}
      <ScrollView
        style={[
          globalStyles.bgWhite,
          globalStyles.padHorizontal,
          globalStyles.padVertical,
        ]}>
        <Image source={TermsLogo} style={styles.logo} />
        <View style={globalStyles.padVertical}>
          <HTML source={{ html: terms }} />
        </View>
      </ScrollView>
    </LayoutWrapper>
  );
};

const styles = StyleSheet.create({
  logo: {
    width: '100%',
    height: 180,
    borderWidth: 1,
    borderColor: '#EBEBEB',
    borderRadius: 10,
  },
  title: {
    fontFamily: fonts.JakartaBold,
    fontSize: 16,
    color: '#303030',
    marginBottom: 10,
  },
  text: {
    fontFamily: fonts.JakartaLight,
    fontSize: 14,
    color: '#000',
    lineHeight: 18,
    textAlign: 'justify',
    marginBottom: 10,
  },
});

export default TermsScreen;
