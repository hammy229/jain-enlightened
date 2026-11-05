import { View, Text, StyleSheet, Image, Pressable } from 'react-native';
import React from 'react';
import { fonts } from '../../assets/fonts';
import { colors } from '../../assets/styles/colors';
import RightArrowButton from '../buttons/RightArrowButton';
import { handleLink } from '../../utils';
import { globalStyles } from '../../assets/styles/globalStyles';
import { RightArrowBlue } from '../../assets/images';

interface AcademicResourceCardProps {
  image: string;
  title: string;
  description: string;
  link: string;
}

const AcademicResourceCard: React.FC<AcademicResourceCardProps> = ({
  image,
  title,
  description,
  link,
}) => {
  return (
    <View style={styles.padRight}>
      <View style={styles.cardContainer}>
        <Image source={{ uri: image }} style={styles.image} />
        <View style={styles.textContainer}>
          <View style={styles.textFirstBox}>
            <Text style={styles.text} numberOfLines={1} ellipsizeMode="tail">
              {title}
            </Text>
            <Text
              style={styles.description}
              numberOfLines={2}
              ellipsizeMode="tail">
              {description}
            </Text>
          </View>
          <Pressable
            onPress={() => handleLink(link)}
            style={globalStyles.rightArrowBtn}>
            <Text
              style={[
                globalStyles.rightArrowBtnTextBlack,
                { color: colors.blue },
              ]}>
              Read More
            </Text>
            <Image
              source={RightArrowBlue}
              style={globalStyles.rightArrowBtnArrow}
            />
          </Pressable>
        </View>
      </View>
    </View>
  );
};

const styles = StyleSheet.create({
  padRight: {
    marginLeft: 5,
    marginRight: 10,
    marginBottom: 10,
  },
  cardContainer: {
    borderRadius: 8,
    shadowColor: '#000',
    shadowOffset: {
      width: 0,
      height: 2,
    },
    shadowOpacity: 0.23,
    shadowRadius: 2.62,

    elevation: 4,
    height: 270,
    width: 205,
    backgroundColor: '#fff',
    padding: 2,
  },
  image: {
    height: 170,
    width: '100%',
    borderRadius: 10,
  },
  textContainer: {
    flex: 1,
    padding: 6,
    gap: 5,
    flexDirection: 'column',
    justifyContent: 'space-between',
  },
  textFirstBox: {
    marginTop: 3,
    flexDirection: 'column',
    gap: 7,
  },
  text: {
    fontSize: 14,
    fontFamily: fonts.JakartaBold,
    color: colors.black,
  },
  description: {
    fontFamily: fonts.JakartaRegular,
    fontSize: 13,
    color: colors.black,
  },
});

export default AcademicResourceCard;
