import {
  StyleSheet,
  Text,
  View,
  ScrollView,
  FlatList,
  Image,
  Pressable,
  Dimensions,
  StatusBar,
} from 'react-native';
import React, { useRef, useState } from 'react';
import { globalStyles } from '../assets/styles/globalStyles';

import { CloseBtn, NoData } from '../assets/images';
import Modal from 'react-native-modal';
import { fonts } from '../assets/fonts';
import HTML from 'react-native-render-html';
import Carousel from 'react-native-reanimated-carousel';
import { Easing, ReduceMotion } from 'react-native-reanimated';

const PhotosScreen = ({ data }) => {
  const [modalVisible, setModalVisible] = useState(false);
  const [selectedImageIndex, setSelectedImageIndex] = useState(0);
  const flatListRef = useRef();

  const handleImagePress = (index) => {
    setSelectedImageIndex(index);
    setModalVisible(true);
  };
  const width = Dimensions.get('window').width;
  const height = Dimensions.get('window').height;

  const renderItem = ({ item, index }) => (
    <Pressable
      style={styles.container}
      onPress={() => {
        handleImagePress(index);
      }}>
      <Image
        source={{ uri: item.gallery_img_path }}
        style={[styles.image, { width: (width - 30) * 0.3 }]}
      />
    </Pressable>
  );

  const renderGalleryImage = ({ item }) => {
    return (
      <View
        style={{
          flex: 1,
          justifyContent: 'center',
          alignItems: 'center',
        }}>
        <View style={styles.modalViewStyle}>
          <Pressable
            style={styles.pressableBtn}
            onPress={() => {
              setModalVisible(false);
            }}>
            <Image source={CloseBtn} style={{ height: 13, width: 13 }} />
          </Pressable>
          <Image
            source={{ uri: item.gallery_img_path }}
            style={styles.modalImageStyle}
          />
          <ScrollView
            showsVerticalScrollIndicator={false}
            style={{ marginHorizontal: 6, paddingBottom: 20 }}>
            {item.description ? (
              <HTML source={{ html: item.description }} />
            ) : null}
          </ScrollView>
        </View>
      </View>
    );
  };

  return (
    <ScrollView style={globalStyles.padVertical}>
      <StatusBar backgroundColor={modalVisible ? '#000000aa' : '#236272'} />

      {data && data.length > 0 ? (
        <FlatList
          data={data}
          renderItem={renderItem}
          keyExtractor={(item) => item.id}
          numColumns={3}
          contentContainerStyle={styles.container}
        />
      ) : (
        <View style={styles.NoDataView}>
          <Image
            source={NoData}
            style={{ height: 200, width: '100%', resizeMode: 'contain' }}
          />
        </View>
      )}
      <Modal
        style={styles.modalStyle}
        statusBarTranslucent
        animationIn="slideInDown"
        animationOut="slideOutUp"
        transparent={true}
        visible={modalVisible}
        onBackdropPress={() => setModalVisible(false)}
        onRequestClose={() => setModalVisible(false)}>
        <Carousel
          loop
          width={width}
          height={height}
          autoPlay={false}
          data={data}
          renderItem={renderGalleryImage}
          scrollAnimationDuration={500}
          defaultIndex={selectedImageIndex}
          withAnimation={{
            type: 'timing',
            config: {
              duration: 250,
              easing: Easing.out(Easing.exp),
              reduceMotion: ReduceMotion.Never,
            },
          }}
        />
      </Modal>
    </ScrollView>
  );
};

export default PhotosScreen;

const styles = StyleSheet.create({
  container: {
    alignSelf: 'center',
  },

  image: {
    // width: 120,
    height: 110,
    resizeMode: 'cover',
    borderRadius: 5,
    margin: 5,
  },
  modalStyle: {
    flex: 1,
    width: '100%',
    marginLeft: 0,
    marginBottom: 0,
    backgroundColor: '#000000aa',
    justifyContent: 'center',
    alignItems: 'center',
  },
  modalViewStyle: {
    backgroundColor: '#FFF',
    maxHeight: 450,
    width: Dimensions.get('window').width * 0.9,
    borderRadius: 8,
    marginHorizontal: 15,
    paddingHorizontal: 15,
    alignItems: 'center',
    alignSelf: 'center',
    justifyContent: 'center',
    paddingBottom: 15,
  },
  modalParaStyle: {
    lineHeight: 23,
    fontSize: 15,
    color: '#000',
    fontFamily: fonts.JakartaRegular,
  },
  modalImageStyle: {
    width: '98%',
    height: 200,
    borderRadius: 6,
    marginTop: 20,
    marginBottom: 15,
  },
  pressableBtn: {
    alignSelf: 'flex-end',
    right: 4,
    top: 10,
    // marginBottom: 5,
    padding: 10,
  },
  NoDataView: {
    height: 500,
    backgroundColor: '#FFF',
    alignItems: 'center',
    justifyContent: 'center',
  },
});
