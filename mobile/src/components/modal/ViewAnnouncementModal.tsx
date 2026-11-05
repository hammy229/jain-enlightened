import {
  StyleSheet,
  Text,
  View,
  Pressable,
  Image,
  Dimensions,
  ScrollView,
} from 'react-native';
import React from 'react';
import Modal from 'react-native-modal';
import { CloseBtn, ModalIcon } from '../../assets/images';
import { fonts } from '../../assets/fonts';

const ViewAnnouncementModal = ({ isVisible, toggle, data }) => {
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

          <View style={styles.announcementViewStyle}>
            <Image
              source={data.image ? { uri: data.image } : ModalIcon}
              style={styles.AnnouncementImgStyle}
            />
            <Text style={styles.AnnouncementTitleStyle}>{data.title}</Text>
          </View>
          <ScrollView
            showsVerticalScrollIndicator={false}
            style={{ marginHorizontal: 6, paddingBottom: 20 }}>
            <Text style={styles.paragraphStyle}>{data.description}</Text>
          </ScrollView>
        </View>
      </Modal>
    </View>
  );
};

export default ViewAnnouncementModal;

const styles = StyleSheet.create({
  modalStyle: {
    width: '100%',
    marginLeft: 0,
    marginBottom: 0,
    backgroundColor: '#000000aa',
  },
  modalViewStyle: {
    backgroundColor: '#FFF',
    minHeight: 450,
    maxHeight: 630,
    width: Dimensions.get('window').width * 0.9,
    borderRadius: 8,
    marginHorizontal: 15,
    paddingHorizontal: 10,
    alignItems: 'center',
    alignSelf: 'center',
  },
  pressableBtn: {
    alignSelf: 'flex-end',
    right: 10,
    top: 20,
    marginBottom: 10,
    padding: 8,
  },
  paragraphStyle: {
    color: '#000000',
    fontSize: 15,
    marginTop: 2,
    lineHeight: 23,
    fontFamily: fonts.JakartaRegular,
    textAlign: 'justify',
    marginBottom: 25,
  },
  announcementViewStyle: {
    borderColor: '#C6E1E8',
    borderWidth: 1,
    flexDirection: 'row',
    alignItems: 'center',
    minHeight: 74,
    width: '98%',
    borderRadius: 6,
    marginTop: 25,
    marginBottom: 10,
    marginHorizontal: 6,
  },
  AnnouncementImgStyle: {
    height: 42,
    width: 42,
    marginLeft: 15,
  },
  AnnouncementTitleStyle: {
    color: '#1E8AA5',
    fontFamily: fonts.JakartaSemiBold,
    fontSize: 17,
    lineHeight: 22,
    marginLeft: 15,
    width: '75%',
  },
});
