import { View, Text, Image, StyleSheet, Pressable } from 'react-native';
import React, { useRef, useState } from 'react';
import { fonts } from '../../assets/fonts';
import ImageSliderModal from '../modal/ImageSliderModal';
import { handleLink } from '../../utils';

interface AboutUsCardProps {
  image: string;
  title: string;
  position: string;
  linkedinUrl: string;
  description: string;
}

const AboutUsCard: React.FC<AboutUsCardProps> = ({
  image,
  title,
  position,
  linkedinUrl,
  description,
}) => {
  const [modalVisible, setModalVisible] = useState(false);

  const toggle = () => {
    setModalVisible(!modalVisible);
  };
  return (
    <View>
      <Pressable
        onPress={() => {
          setModalVisible(true);
        }}
        style={styles.padRight}>
        <View
          style={[
            styles.cardContainer,
            {
              height: 280,
              width: 205,
            },
          ]}>
          <Image source={{ uri: image }} style={styles.image} />
          <Pressable onPress={() => handleLink(linkedinUrl)}>
            <Image
              source={require('../../assets/images/LinkedInBtn.png')}
              style={{
                height: 28,
                width: 90,
                position: 'absolute',
                marginTop: -35,
                left: 9,
              }}
              resizeMode="cover"
            />
          </Pressable>
          <View style={styles.textContainer}>
            <Text style={styles.text} numberOfLines={1} ellipsizeMode="tail">
              {title}
            </Text>
            <Text style={styles.subText} numberOfLines={1} ellipsizeMode="tail">
              {position}
            </Text>
          </View>
        </View>
      </Pressable>
      <ImageSliderModal
        isVisible={modalVisible}
        toggle={toggle}
        image={image}
        title={title}
        position={position}
        description={description}
      />
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
    backgroundColor: '#fff',
    padding: 2,
    paddingBottom: 10,
  },
  image: {
    height: '79%',
    width: '100%',
    borderRadius: 8,
  },
  textContainer: {
    padding: 6,
  },
  text: {
    fontSize: 17,
    color: '#000000',
    fontFamily: fonts.JakartaExtraBold,
    lineHeight: 22,
  },
  subText: {
    fontSize: 15,
    color: '#000000',
    paddingVertical: 5,
    fontFamily: fonts.JakartaRegular,
    lineHeight: 19,
  },
});

export default AboutUsCard;
