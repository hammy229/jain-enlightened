import { View, Text, ScrollView, StyleSheet, Image } from 'react-native';
import React from 'react';
import LayoutWrapper from '../layouts/LayoutWrapper';
import SecondaryPageHeader from '../components/SecondaryPageHeader';
import { fonts } from '../assets/fonts';
import { globalStyles } from '../assets/styles/globalStyles';
import { splitHeading } from '../utils';
import HTML from 'react-native-render-html';

const MissionScreen = ({ route }) => {
  const pageDetails = route.params?.pageDetails;

  return (
    <LayoutWrapper>
      {/* FounderMessage Header */}
      <SecondaryPageHeader title="Mission" />

      {/*FounderMessage Data */}
      <ScrollView
        style={[{ paddingVertical: 10, flex: 1 }, globalStyles.padHorizontal]}>
        <Text
          style={[
            styles.HeaderText,
            { marginTop: 10, marginBottom: 15, fontSize: 20, lineHeight: 27 },
          ]}>
          {splitHeading(pageDetails.about_heading).mainText}
          <Text style={styles.spanstyle}>
            {' '}
            {splitHeading(pageDetails.about_heading).highlightedText}
          </Text>
        </Text>

        <Image
          source={{ uri: pageDetails.about_image_path }}
          style={styles.imgStyle}
          resizeMode="cover"
        />

        <View style={{ marginVertical: 10 }}>
          <HTML source={{ html: pageDetails.about_description }} />
        </View>
      </ScrollView>
    </LayoutWrapper>
  );
};

export default MissionScreen;

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
