import {
  StyleSheet,
  Text,
  View,
  FlatList,
  Dimensions,
  Pressable,
  Image,
} from 'react-native';
import React, { useRef, useState } from 'react';
import Modal from 'react-native-modal';
import { Arrow, CloseBtn } from '../../assets/images';
import { fonts } from '../../assets/fonts';
import { ScrollView } from 'react-native-gesture-handler';
import HTML from 'react-native-render-html';

const ImageSliderModal = ({
  isVisible,
  toggle,
  image,
  title,
  position,
  description,
}) => {
  const [selectedImageIndex, setSelectedImageIndex] = useState(0);
  const flatListRef = useRef();

  return (
    <View style={{ flex: 1 }}>
      <Modal
        style={styles.modalStyle}
        statusBarTranslucent
        animationIn="slideInDown"
        animationOut="slideOutUp"
        transparent={true}
        visible={isVisible}
        onBackdropPress={() => toggle()}
        onRequestClose={() => toggle()}>
        <View style={styles.modalViewStyle}>
          <Pressable
            style={styles.pressableBtn}
            onPress={() => {
              toggle();
            }}>
            <Image source={CloseBtn} style={{ height: 13, width: 13 }} />
          </Pressable>
          <Image
            source={{ uri: image }}
            resizeMode="contain"
            style={styles.modalImageStyle}
          />
          <View style={styles.textContainer}>
            <View style={{ width: '70%' }}>
              <Text style={styles.text}>{title}</Text>
              <Text style={styles.subText}>{position}</Text>
            </View>
            <Pressable
              onPress={() => {}}
              style={{
                width: '25%',
              }}>
              <Image
                source={require('../../assets/images/LinkedInBtn.png')}
                style={{
                  height: 26,
                  width: 89,
                }}
                resizeMode="cover"
              />
            </Pressable>
          </View>
          <View style={styles.borderStyle} />
          <ScrollView
            style={{ maxHeight: 200, marginBottom: 20, paddingHorizontal: 5 }}>
            {/* <Text style={styles.modalParaStyle}>{description}</Text> */}
            <HTML source={{ html: description }} />
          </ScrollView>
        </View>
      </Modal>
    </View>
  );
};

export default ImageSliderModal;

const styles = StyleSheet.create({
  modalStyle: {
    width: '100%',
    marginLeft: 0,
    marginBottom: 0,
    backgroundColor: '#000000aa',
  },
  modalViewStyle: {
    backgroundColor: '#FFF',
    minHeight: 530,
    width: Dimensions.get('window').width * 0.9,
    borderRadius: 8,
    marginHorizontal: 15,
    paddingHorizontal: 10,
    alignItems: 'center',
    alignSelf: 'center',
  },
  modalImageStyle: {
    width: '98%',
    height: 200,
    borderRadius: 6,
    marginTop: 30,
    marginBottom: 15,
  },
  modalParaStyle: {
    lineHeight: 23,
    fontSize: 15,
    color: '#000',
    fontFamily: fonts.JakartaRegular,
    textAlign: 'justify',
  },
  pressableBtn: {
    alignSelf: 'flex-end',
    right: 10,
    top: 20,
    marginBottom: 10,
  },
  textContainer: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    width: '100%',
    padding: 6,
  },
  text: {
    fontSize: 17,
    color: '#167E98',
    fontFamily: fonts.JakartaExtraBold,
    lineHeight: 22,
  },
  subText: {
    fontSize: 17,
    color: '#000000',
    paddingVertical: 5,
    fontFamily: fonts.JakartaMedium,
    lineHeight: 19,
  },
  borderStyle: {
    marginBottom: 15,
    borderColor: '#D9D9D9',
    borderWidth: 0.7,
    height: 0,
    width: '98%',
  },
  readmoretext: {
    color: '#167E98',
    fontSize: 14,
    fontFamily: fonts.OpenSansSemiBold,
  },
});
