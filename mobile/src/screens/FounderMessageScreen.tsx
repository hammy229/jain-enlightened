import { StyleSheet, Text, View, ScrollView, Image } from 'react-native';
import React, { useEffect, useState } from 'react';
import LayoutWrapper from '../layouts/LayoutWrapper';
import SecondaryPageHeader from '../components/SecondaryPageHeader';
import { globalStyles } from '../assets/styles/globalStyles';
import { fonts } from '../assets/fonts';
import { splitHeading } from '../utils';
import HTML from 'react-native-render-html';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { fetchFoundersDetails } from '../api/api';
import Loader from '../components/Loader';

const FounderMessageScreen = () => {
  const [founderDetails, setFounderDetails] = useState();
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const getFounderDetails = async () => {
      try {
        const url = await AsyncStorage.getItem('baseUrl');

        if (url) {
          const response = await fetchFoundersDetails(url);
          setFounderDetails(response);
        } else {
          console.log('Base URL not found in AsyncStorage');
        }
      } catch (error) {
        console.log('Error fetching getFounderDetails: ', error);
      } finally {
        setLoading(false);
      }
    };

    getFounderDetails();
  }, []);

  if (loading) {
    return <Loader />;
  }

  return (
    <LayoutWrapper>
      {/* FounderMessage Header */}
      <SecondaryPageHeader title="Founder Message" />

      {/*FounderMessage Data */}
      <ScrollView
        style={[{ paddingVertical: 10, flex: 1 }, globalStyles.padHorizontal]}>
        <Text
          style={[
            styles.HeaderText,
            { marginTop: 10, marginBottom: 15, fontSize: 20, lineHeight: 27 },
          ]}>
          {splitHeading(founderDetails.founders_heading).mainText}
          <Text style={styles.spanstyle}>
            {' '}
            {splitHeading(founderDetails.founders_heading).highlightedText}
          </Text>
        </Text>

        <Image
          source={{ uri: founderDetails.founders_image_path }}
          style={styles.imgStyle}
          resizeMode="cover"
        />

        <View style={{ marginVertical: 10 }}>
          <HTML source={{ html: founderDetails.founders_description }} />
        </View>
      </ScrollView>
    </LayoutWrapper>
  );
};

export default FounderMessageScreen;

const styles = StyleSheet.create({
  HeaderText: {
    fontSize: 21,
    color: '#000',
    fontFamily: fonts.JakartaMedium,
    lineHeight: 27,
  },
  borderStyle: {
    marginVertical: 10,
    borderColor: '#D9D9D9',
    borderWidth: 0.6,
    height: 0,
  },
  spanstyle: {
    color: '#167E98',
    fontFamily: fonts.JakartaBold,
    lineHeight: 27,
  },
  imgStyle: {
    height: 200,
    width: '100%',
    borderRadius: 5,
  },
  paragraphStyle: {
    fontFamily: fonts.JakartaRegular,
    fontSize: 15,
    lineHeight: 22,
    color: '#000',
    marginVertical: 10,
    textAlign: 'justify',
  },
});
