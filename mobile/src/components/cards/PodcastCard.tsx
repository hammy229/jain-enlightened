import {
  View,
  Text,
  Image,
  StyleSheet,
  Pressable,
  Dimensions,
} from 'react-native';
import React, { useState } from 'react';
import LinearGradient from 'react-native-linear-gradient';
import { globalStyles } from '../../assets/styles/globalStyles';
import { YoutubePlay } from '../../assets/images';
import YoutubePlayerModal from '../modal/YoutubePlayerModal';

interface PodcastCardProps {
  title: string;
  image: string;
  ytLink: string;
}
const width = Dimensions.get('window').width;

const PodcastCard: React.FC<PodcastCardProps> = ({ title, image, ytLink }) => {
  const [youtubePlayer, setYoutubePlayer] = useState(false);
  const [videoId, setVideoId] = useState('');

  const getVideoId = (url) => {
    const pattern =
      /(?:youtube\.com\/(?:[^/]+\/.+\/|(?:v|e(?:mbed)?)\/|[^#]*[?&]v=|[^#]*)|youtu\.be\/)([^"&?/ ]{11})/i;
    const match = url.match(pattern);
    setVideoId(match[1]);
    return match ? match[1] : null;
  };

  const handleImagePress = (item) => {
    setYoutubePlayer(true);
    getVideoId(item.youtubeLink);
  };

  return (
    <View style={globalStyles.padHorizontal}>
      <View style={[styles.podcastCartContainer, globalStyles.cardShadow]}>
        <YoutubePlayerModal
          youtubePlayer={youtubePlayer}
          setYoutubePlayer={setYoutubePlayer}
          setVideoId={setVideoId}
          videoId={videoId}
        />
        <Pressable
          onPress={() =>
            handleImagePress({
              youtubeLink: ytLink,
            })
          }
          style={styles.imageBox}>
          <LinearGradient
            colors={['rgba(0, 0, 0, 0.0567)', 'rgba(0, 0, 0, 0.5589)']}
            style={[globalStyles.overlay, { zIndex: 1 }]}
            start={{ x: 0.5, y: 0 }}
            end={{ x: 0.5, y: 1 }}
          />
          <Image source={{ uri: image }} style={styles.thumbnail} />
          <Image source={YoutubePlay} style={styles.youtubeBtn} />
        </Pressable>
        <View style={[globalStyles.padHorizontal, { paddingTop: 10 }]}>
          <Text style={styles.title} numberOfLines={2} ellipsizeMode="tail">
            {title}
          </Text>
        </View>
      </View>
    </View>
  );
};

const styles = StyleSheet.create({
  podcastCartContainer: {
    minHeight: 255,
    // width: width * 0.9,
    borderRadius: 10,
    // overflow: 'hidden',
    backgroundColor: '#fff',
    marginBottom: 20,
    shadowColor: '#000',
  },
  imageBox: {
    height: 200,
    width: '100%',
    objectFit: 'cover',
    position: 'relative',
    justifyContent: 'center',
    alignItems: 'center',
  },
  title: {
    fontWeight: '700',
    fontSize: 15,
    color: '#303030',
  },
  thumbnail: {
    height: '100%',
    width: '100%',
    objectFit: 'cover',
    borderRadius: 10,
  },
  youtubeBtn: {
    position: 'absolute',
    width: 50,
    objectFit: 'contain',
  },
});

export default PodcastCard;
