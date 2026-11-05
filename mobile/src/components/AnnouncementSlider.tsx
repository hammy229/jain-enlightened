import {
  View,
  Text,
  StyleSheet,
  Dimensions,
  Image,
  Pressable,
  StatusBar,
} from 'react-native';
import React, { useState } from 'react';
import { fonts } from '../assets/fonts';
import ViewAnnouncementModal from './modal/ViewAnnouncementModal';

const { width: screenWidth } = Dimensions.get('window');

interface Item {
  title: string;
  description: string;
}

interface AnnouncementSliderProp {
  item: Item;
}

const AnnouncementSlider: React.FC<AnnouncementSliderProp> = ({ item }) => {
  // console.log(item.image);

  const [modalVisible, setModalVisible] = useState(false);

  const toggle = () => {
    setModalVisible(!modalVisible);
  };

  return (
    <View style={{ flex: 1 }}>
      <StatusBar backgroundColor={modalVisible ? '#000000aa' : null} />
      <Pressable style={styles.slide} onPress={() => toggle()}>
        <View style={styles.imageContainer}>
          <Image source={{ uri: item.image }} style={styles.image} />
        </View>
        <View style={styles.textContainer}>
          <Text style={styles.title}>{item.title}</Text>
          <Text
            numberOfLines={3}
            ellipsizeMode="tail"
            style={styles.description}>
            {item.description}
          </Text>
        </View>
      </Pressable>
      <ViewAnnouncementModal
        isVisible={modalVisible}
        toggle={toggle}
        data={item}
      />
    </View>
  );
};

const styles = StyleSheet.create({
  slide: {
    flexDirection: 'row',
    gap: 10,
    borderRadius: 5,
    width: screenWidth - 40,
    backgroundColor: '#F0F5FF',
    height: 110,
    padding: 15,
  },
  imageContainer: {
    width: '20%',
    backgroundColor: '#fff',
    flex: 1,
    borderRadius: 5,
    justifyContent: 'center',
    alignItems: 'center',
  },
  image: {
    height: '80%',
    width: '80%',
    resizeMode: 'contain',
  },
  textContainer: {
    width: '74%',
  },
  title: {
    fontFamily: fonts.JakartaSemiBold,
    color: '#1E8AA5',
    fontSize: 15,
    marginBottom: 3,
  },
  description: {
    fontFamily: fonts.JakartaMedium,
    color: '#6B6B6B',
    fontSize: 12,
  },
});

export default AnnouncementSlider;
