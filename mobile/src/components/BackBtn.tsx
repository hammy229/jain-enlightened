import { StyleSheet, TouchableOpacity, Image } from 'react-native'
import React from 'react'
import { LefArrow } from '../assets/images'
import { useNavigation } from '@react-navigation/native'
import { globalStyles } from '../assets/styles/globalStyles'

const BackBtn = () => {

    const navigation = useNavigation();

  return (
    <TouchableOpacity 
        style={globalStyles.navBtnContainer}
        onPress={() => navigation.goBack()}
    >
        <Image source={LefArrow} style={styles.backBtn} />
    </TouchableOpacity>
  )
}

const styles = StyleSheet.create({
    backBtn: {
        height: 25, 
        width: 25, 
        objectFit: "contain"
    },
});

export default BackBtn