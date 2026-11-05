import { Image, TouchableOpacity, StyleSheet } from 'react-native'
import React from 'react'
import { DrawerButton } from '../assets/images'
import { useNavigation } from '@react-navigation/native'
import { globalStyles } from '../assets/styles/globalStyles'

const DrawerOpenBtn = () => {

    const navigation = useNavigation();

  return (
        <TouchableOpacity 
            style={globalStyles.navBtnContainer}
            onPress={() => navigation.openDrawer()}
        >
            <Image source={DrawerButton} style={styles.drawerBtn} />
        </TouchableOpacity>
  )
}

const styles = StyleSheet.create({
    drawerBtn: {
        height: 35, 
        width: 35, 
        objectFit: "contain"
    },
});

export default DrawerOpenBtn