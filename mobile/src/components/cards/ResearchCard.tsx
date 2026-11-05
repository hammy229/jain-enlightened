import {
  View,
  Text,
  Image,
  Pressable,
  StyleSheet,
  Linking,
} from 'react-native';
import React from 'react';
import { Download, Resource2, RightArrowBlue } from '../../assets/images';
import { globalStyles } from '../../assets/styles/globalStyles';
import { colors } from '../../assets/styles/colors';
import { handleLink } from '../../utils';
import HTML from 'react-native-render-html';

interface ResearchCardProps {
  title: string;
  description: string;
  image: any;
  activeNav: string;
  Link: string;
}

const ResearchCard: React.FC<ResearchCardProps> = ({
  title,
  description,
  image,
  activeNav,
  Link,
}) => {
  return (
    <View style={[globalStyles.padHorizontal, {}]}>
      <View style={[styles.container, globalStyles.cardShadow]}>
        <Image
          source={image !== '' ? { uri: image } : Resource2}
          style={styles.image}
        />
        <View style={globalStyles.padHorizontal}>
          <Text style={styles.title}>{title}</Text>
          {/* <Text style={styles.description}>{description}</Text> */}
          <View style={{ marginTop: 5 }}>
            <HTML source={{ html: description }} />
          </View>
          {activeNav == '1' ? (
            <Pressable
              onPress={() => {
                Linking.openURL(Link);
              }}
              style={styles.downloadBtn}>
              <Text style={styles.downloadText}>Download PDF</Text>
              <Image source={Download} style={styles.downloadIcon} />
            </Pressable>
          ) : (
            <Pressable
              onPress={() => handleLink(Link)}
              style={[globalStyles.rightArrowBtn, { marginTop: 12 }]}>
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
          )}
        </View>
      </View>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    minHeight: 285,
    width: '100%',
    borderRadius: 10,
    backgroundColor: '#fff',
    marginBottom: 20,
    paddingBottom: 15,
  },
  image: {
    height: 175,
    width: '100%',
    position: 'relative',
    justifyContent: 'center',
    alignItems: 'center',
    resizeMode: 'cover',
    borderTopLeftRadius: 10,
    borderTopRightRadius: 10,
  },
  description: {
    fontSize: 13,
    fontWeight: '400',
    color: '#303030',
    marginTop: 10,
  },
  title: {
    fontSize: 15,
    fontWeight: '700',
    color: '#303030',
    marginTop: 10,
  },
  downloadBtn: {
    marginTop: 10,
    backgroundColor: '#E5A230',
    borderRadius: 4,
    flexDirection: 'row',
    alignItems: 'center',
    paddingVertical: 5,
    paddingHorizontal: 10,
    alignSelf: 'flex-start',
  },
  downloadText: {
    fontSize: 13,
    color: '#fff',
  },
  downloadIcon: {
    height: 13,
    width: 13,
    objectFit: 'contain',
  },
});

export default ResearchCard;
