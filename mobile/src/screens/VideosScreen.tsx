import {
  StyleSheet,
  Text,
  View,
  ScrollView,
  FlatList,
  Image,
  TouchableOpacity,
  Modal,
  StatusBar,
  Dimensions,
} from 'react-native';
import React, { useState } from 'react';
import { globalStyles } from '../assets/styles/globalStyles';
import { CircleClose, NoData, VideoIcon } from '../assets/images';
import YoutubeIframe from 'react-native-youtube-iframe';

const VideosScreen = ({ data }) => {
  const [youtubePlayer, setYoutubePlayer] = useState(false);
  const [videoId, setVideoId] = useState('');

  const width = Dimensions.get('window').width;

  const getVideoId = (url) => {
    const pattern =
      /(?:youtube\.com\/(?:[^/]+\/.+\/|(?:v|e(?:mbed)?)\/|[^#]*[?&]v=|[^#]*)|youtu\.be\/)([^"&?/ ]{11})/i;
    const match = url.match(pattern);
    return match ? match[1] : null;
  };

  const getThumbnailUrl = (videoUrl) => {
    const videoId = getVideoId(videoUrl);
    return videoId
      ? `https://img.youtube.com/vi/${videoId}/hqdefault.jpg`
      : null;
  };

  const VideoCard = ({ item, itemIndex }) => {
    const getVideoId = (url) => {
      const pattern =
        /(?:youtube\.com\/(?:[^/]+\/.+\/|(?:v|e(?:mbed)?)\/|[^#]*[?&]v=|[^#]*)|youtu\.be\/)([^"&?/ ]{11})/i;
      const match = url.match(pattern);
      setVideoId(match[1]);
      return match ? match[1] : null;
    };

    const handleImagePress = (item) => {
      const videoId = getVideoId(item.gallery_video_link);
      if (videoId) {
        setYoutubePlayer(true);
        setVideoId(videoId);
      }
    };

    const thumbnailUrl = getThumbnailUrl(item.gallery_video_link);

    return (
      <TouchableOpacity
        onPress={() => {
          handleImagePress(item);
        }}
        style={{}}>
        <View style={styles.container}>
          {/* <Image source={item.uri} style={styles.image} /> */}
          {thumbnailUrl ? (
            <Image
              source={{ uri: thumbnailUrl }}
              style={[styles.image, { width: (width - 30) * 0.3 }]}
            />
          ) : (
            <Text>Invalid Video URL</Text>
          )}
          <View
            style={{
              position: 'absolute',
              alignSelf: 'center',
              marginTop: 50,
            }}>
            <Image
              source={VideoIcon}
              style={{
                height: 28,
                width: 28,
              }}
            />
          </View>
        </View>
      </TouchableOpacity>
    );
  };

  return (
    <ScrollView style={[globalStyles.padVertical, globalStyles.bgWhite]}>
      <StatusBar backgroundColor={youtubePlayer ? '#000000aa' : '#236272'} />

      {data && data.length > 0 ? (
        <FlatList
          data={data}
          renderItem={({ item, index: itemIndex }) => (
            <VideoCard item={item} itemIndex={itemIndex} />
          )}
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
        onRequestClose={() => {
          setYoutubePlayer(false);
        }}
        visible={youtubePlayer}
        transparent={true}>
        <View
          style={{
            backgroundColor: '#000000aa',
            position: 'absolute',
            width: '100%',
            height: '100%',
            justifyContent: 'center',
            alignItems: 'center',
          }}>
          <View
            style={{
              alignSelf: 'center',
              width: '95%',
              marginVertical: '30%',
            }}>
            <View>
              <TouchableOpacity
                style={{
                  alignSelf: 'flex-end',
                }}
                onPress={() => {
                  setYoutubePlayer(false);
                  setVideoId('');
                }}>
                <Image
                  source={CircleClose}
                  style={{
                    height: 25,
                    width: 25,
                  }}
                />
              </TouchableOpacity>
              <YoutubeIframe
                webViewStyle={{ borderRadius: 10 }}
                height={300}
                play={true}
                videoId={videoId}
                mute={true}
              />
            </View>
          </View>
        </View>
      </Modal>
    </ScrollView>
  );
};

export default VideosScreen;

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
  NoDataView: {
    height: 500,
    backgroundColor: '#FFF',
    alignItems: 'center',
    justifyContent: 'center',
  },
});
