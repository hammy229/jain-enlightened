import { View, Modal, TouchableOpacity, Image, StyleSheet } from 'react-native';
import React from 'react';
import YoutubeIframe from 'react-native-youtube-iframe';
import { Close } from '../../assets/images';

const YoutubePlayerModal = ({
  youtubePlayer,
  setYoutubePlayer,
  setVideoId,
  videoId,
}) => {
  return (
    <Modal visible={youtubePlayer} transparent={true}>
      <View style={styles.container}>
        <View style={styles.subContainer}>
          <View>
            <TouchableOpacity
              style={styles.closeBtnContainer}
              onPress={() => {
                setYoutubePlayer(false);
                setVideoId('');
              }}>
              <Image source={Close} style={styles.closeIcon} />
            </TouchableOpacity>
            <YoutubeIframe
              height={300}
              play={true}
              videoId={videoId}
              mute={true}
            />
          </View>
        </View>
      </View>
    </Modal>
  );
};

const styles = StyleSheet.create({
  container: {
    backgroundColor: '#000000aa',
    position: 'absolute',
    width: '100%',
    height: '100%',
    justifyContent: 'center',
    alignItems: 'center',
  },
  subContainer: {
    alignSelf: 'center',
    width: '95%',
    marginVertical: '30%',
  },
  closeBtnContainer: {
    alignSelf: 'flex-end',
  },
  closeIcon: {
    height: 25,
    width: 25,
    alignSelf: 'flex-end',
    marginBottom: 5,
  },
});

export default YoutubePlayerModal;
