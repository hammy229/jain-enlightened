import { View, Text, Image, StyleSheet, Pressable } from 'react-native';
import React, { useRef, useState } from 'react';
import { useNavigation } from '@react-navigation/native';
import { globalStyles } from '../../assets/styles/globalStyles';

const GoalsCard = ({ item }) => {
  const navigation = useNavigation();
  return (
    <View style={globalStyles.padHorizontal}>
      <View style={styles.cardContainer}>
        <Image
          source={{ uri: item?.strategic_img_path }}
          style={styles.image}
        />
        <View style={styles.textContainer}>
          <Text style={styles.text}>{item.heading}</Text>
          <Pressable
            onPress={() =>
              navigation.navigate('StrategicGoals', { item: item })
            }>
            <Text style={{ color: '#167E98', fontSize: 14 }}>
              {`Read More  `}
              <Image
                source={require('../../assets/images/Arrow.png')}
                style={{ height: 10, width: 8 }}
                resizeMode="contain"
              />
            </Text>
          </Pressable>
        </View>
      </View>
    </View>
  );
};

const styles = StyleSheet.create({
  padRight: {
    marginLeft: 5,
    marginHorizontal: 10,
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
    height: 250,
    // width: 390,
    elevation: 4,
    backgroundColor: '#fff',
    padding: 2,
  },
  image: {
    height: '65%',
    width: '100%',
    borderTopLeftRadius: 8,
    borderTopRightRadius: 8,
  },
  textContainer: {
    flex: 1,
    padding: 6,
  },
  text: {
    fontSize: 16,
    fontWeight: 'bold',
    color: '#000000',
    paddingVertical: 5,
  },
  subText: {
    fontSize: 15,
    color: '#000000',
    marginVertical: 5,
  },
});

export default GoalsCard;
