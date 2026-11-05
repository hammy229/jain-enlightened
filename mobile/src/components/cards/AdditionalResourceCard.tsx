import {
  View,
  Text,
  ImageBackground,
  StyleSheet,
  Pressable,
  Image,
} from 'react-native';
import React from 'react';
import { globalStyles } from '../../assets/styles/globalStyles';
import LinearGradient from 'react-native-linear-gradient';
import RightArrowButton from '../buttons/RightArrowButton';
import { colors } from '../../assets/styles/colors';
import { handleLink } from '../../utils';
import { fonts } from '../../assets/fonts';
import { RightArrowBlue } from '../../assets/images';

interface AdditionalResourceCardProps {
  title: string;
  description: string;
  image: string;
}

const AdditionalResourceCard = ({ title, description, image, link }) => {
  return (
    <View style={globalStyles.padHorizontal}>
      <View style={[styles.cardContainer, globalStyles.mb12]}>
        <ImageBackground
          source={{ uri: image }}
          style={styles.imageBackground}
          imageStyle={styles.image}>
          <LinearGradient
            colors={[
              'rgba(255, 255, 255, 0.965)',
              'rgba(255, 255, 255, 0.850)',
            ]}
            start={{ x: 0, y: 0 }}
            end={{ x: 1, y: 0 }}
            style={styles.overlay}>
            <Text style={styles.title} numberOfLines={1} ellipsizeMode="tail">
              {title}
            </Text>
            <Text
              style={styles.subtitle}
              numberOfLines={2}
              ellipsizeMode="tail">
              {description}
            </Text>
            <View style={styles.readMoreButton}>
              <Pressable
                onPress={() => handleLink(link)}
                style={styles.rightArrowBtn}>
                <Text
                  style={[
                    styles.rightArrowBtnTextBlack,
                    { color: colors.blue },
                  ]}>
                  Read More
                </Text>
                <Image
                  source={RightArrowBlue}
                  style={styles.rightArrowBtnArrow}
                />
              </Pressable>
            </View>
          </LinearGradient>
        </ImageBackground>
      </View>
    </View>
  );
};

const styles = StyleSheet.create({
  cardContainer: {
    borderRadius: 10,
    overflow: 'hidden',
  },
  imageBackground: {
    width: '100%',
    height: 250,
    justifyContent: 'flex-end',
  },
  image: {
    borderRadius: 10,
  },
  overlay: {
    padding: 10,
    margin: 10,
    borderRadius: 5,
  },
  title: {
    color: '#000',
    fontSize: 16,
    fontWeight: 'bold',
    marginBottom: 5,
  },
  subtitle: {
    color: '#000',
    fontSize: 14,
    marginBottom: 10,
  },
  readMoreButton: {
    alignSelf: 'flex-end',
    backgroundColor: '#fff',
    paddingVertical: 5,
    paddingHorizontal: 15,
    borderRadius: 5,
  },
  readMoreText: {
    color: '#1E8AA5',
    fontWeight: 'bold',
  },
  rightArrowBtn: {
    flexDirection: 'row',
    alignItems: 'baseline',
    gap: 6,
  },
  rightArrowBtnTextBlack: {
    fontSize: 13,
    fontWeight: '600',
    fontFamily: fonts.OpenSansSemiBold,
  },
  rightArrowBtnArrow: {
    height: 9,
    width: 8,
    objectFit: 'contain',
  },
});

export default AdditionalResourceCard;
