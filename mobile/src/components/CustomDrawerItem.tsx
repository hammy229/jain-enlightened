import { Text, StyleSheet, Image, View } from 'react-native'
import React from 'react'
import { useNavigation } from '@react-navigation/native'
import { TouchableOpacity } from 'react-native-gesture-handler';
import LinearGradient from 'react-native-linear-gradient';
import { RightArrow } from '../assets/images';

interface CustomDrawerItemProps {
    label: string,
    icon: any,
    route: string,
    isActive: boolean,
}

const CustomDrawerItem: React.FC<CustomDrawerItemProps> = ({label, icon, route, isActive}) => {

    const navigation = useNavigation();

  return (
    <LinearGradient
        colors={
            isActive 
            ? ['rgba(255, 255, 255, 0.22)', 'rgba(255, 255, 255, 0)'] 
            : ['transparent', 'transparent']
        }
        start={{ x: 0, y: 0 }}
        end={{ x: 1, y: 0 }}
    >
        <TouchableOpacity 
            onPress={() => navigation.navigate(route)}
            style={styles.container}
        >   
            <View style={styles.itemContainer}>
                <Image 
                    source={icon} 
                    style={[styles.icon, {tintColor: isActive ? "#8BE7B1" : "#fff"}]} 
                />
                <Text style={isActive ? styles.activeText : styles.text}>{label}</Text>
            </View>
            {isActive && (
                <View>
                    <Image source={RightArrow} style={styles.rightArrow} />
                </View>
            )}
        </TouchableOpacity>
    </LinearGradient>
  )
}

const styles = StyleSheet.create({
    container: {
        paddingHorizontal: 20,
        paddingVertical: 15,
        flexDirection: "row",
        alignItems: "center"
    },
    itemContainer: {
        flexDirection: "row",
        justifyContent: "flex-start",
        alignItems: "center",
        gap: 15,
        width: "92.5%"
    },
    icon: {
        height: 24,
        width: 24,
        objectFit: 'contain'
    },
    text: {
        color: "#fff",
        fontSize: 16
    },
    activeText: {
        color: "#8BE7B1",
        fontSize: 16
    },
    rightArrow: {
        height: 10,
        width: 8,
        objectFit: "contain"
    }    
})

export default CustomDrawerItem