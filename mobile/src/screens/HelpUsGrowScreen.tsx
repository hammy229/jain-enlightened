import React, { useEffect, useState } from 'react';
import {
  ScrollView,
  View,
  Text,
  Image,
  StyleSheet,
  RefreshControl,
} from 'react-native';
import SecondaryPageHeader from '../components/SecondaryPageHeader';
import { globalStyles } from '../assets/styles/globalStyles';
import { fonts } from '../assets/fonts';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { fetchHelpUsGrow } from '../api/api';
import Loader from '../components/Loader';

const HelpUsGrow = () => {
  const [bankDetails, setBankDetails] = useState();
  const [loading, setLoading] = useState(true);
  const [refreshing, setRefreshing] = useState(false);

  const onRefresh = async () => {
    setRefreshing(true);
    await getBankDetails();
    setRefreshing(false);
  };

  const getBankDetails = async () => {
    try {
      const url = await AsyncStorage.getItem('baseUrl');

      if (url) {
        const response = await fetchHelpUsGrow(url);
        setBankDetails(response);
      } else {
        console.log('Base URL not found in AsyncStorage');
      }
    } catch (error) {
      console.log('Error fetching bankDetails: ', error);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    getBankDetails();
  }, []);

  if (loading) {
    return <Loader />;
  }

  return (
    <ScrollView
      refreshControl={
        <RefreshControl refreshing={refreshing} onRefresh={onRefresh} />
      }
      contentContainerStyle={styles.container}>
      {/* Help Us Grow Header */}
      <SecondaryPageHeader title="Help Us Grow" borderRadius={0} />
      {/* Help Us Details */}
      <View
        style={[globalStyles.padHorizontal, globalStyles.headerThree]}></View>

      <View style={globalStyles.layoutThreeBox}>
        <View style={[styles.section, globalStyles.cardShadow]}>
          <Text
            style={[globalStyles.sectionTitleBlack, { textAlign: 'center' }]}>
            Scan in your{' '}
          </Text>
          <Text
            style={[
              globalStyles.sectionTitleBlue,
              { textAlign: 'center', marginBottom: 12 },
            ]}>
            Banking App to Pay
          </Text>
          <Text style={styles.subTitle}>{bankDetails?.scanner_heading_1}</Text>
          <Image
            source={{ uri: bankDetails?.scanner_img_path_1 }}
            style={styles.qrCode}
          />
          <Text style={styles.scanText}>Scan. Pay. Go.</Text>
        </View>

        <View style={[styles.section, globalStyles.cardShadow]}>
          <Text style={styles.subTitle}>{bankDetails?.scanner_heading_2}</Text>
          <Image
            source={{ uri: bankDetails?.scanner_img_path_2 }}
            style={styles.qrCode}
          />
          <Text style={styles.scanText}>Scan. Pay. Go.</Text>
        </View>

        <Text style={[globalStyles.sectionTitleBlack, { marginBottom: 12 }]}>
          Bank <Text style={globalStyles.sectionTitleBlue}>Details</Text>
        </Text>
        <View style={styles.bankDetails}>
          <View style={styles.bankRow}>
            <View style={{ width: '45%' }}>
              <Text style={styles.bankLabel}>Bank Name</Text>
              <Text style={styles.bankValue}>{bankDetails?.bank_name}</Text>
            </View>
            <View>
              <Text style={styles.bankLabel}>Account Holder Name</Text>
              <Text style={styles.bankValue}>
                {bankDetails?.account_holder_name}
              </Text>
            </View>
          </View>
          <View style={styles.bankRow}>
            <View style={{ width: '45%' }}>
              <Text style={styles.bankLabel}>Account Number</Text>
              <Text style={styles.bankValue}>
                {bankDetails?.account_number}
              </Text>
            </View>
            <View>
              <Text style={styles.bankLabel}>IFSC Code</Text>
              <Text style={styles.bankValue}>{bankDetails?.ifsc_code}</Text>
            </View>
          </View>
        </View>
      </View>
    </ScrollView>
  );
};

const styles = StyleSheet.create({
  container: {
    backgroundColor: '#fff',
  },
  header: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    paddingBottom: 16,
  },
  headerTitle: {
    fontSize: 18,
    fontWeight: 'bold',
    color: '#fff',
  },
  section: {
    backgroundColor: '#fff',
    padding: 16,
    borderRadius: 8,
    marginBottom: 16,
  },
  subTitle: {
    fontSize: 14,
    marginBottom: 8,
    fontFamily: fonts.JakartaBold,
    color: '#303030',
    textAlign: 'center',
  },
  qrCode: {
    width: 150,
    height: 150,
    alignSelf: 'center',
    marginBottom: 8,
  },
  scanText: {
    textAlign: 'center',
    fontSize: 14,
    color: '#167E98',
    fontFamily: fonts.JakartaBold,
    marginBottom: 16,
  },
  bankDetails: {
    backgroundColor: '#F0F5FF',
    padding: 16,
    borderRadius: 8,
  },
  bankRow: {
    flexDirection: 'row',
    marginBottom: 8,
  },
  bankLabel: {
    fontSize: 14,
    fontFamily: fonts.JakartaBold,
    color: '#167E98',
  },
  bankValue: {
    fontSize: 12,
    fontFamily: fonts.JakartaMedium,
    color: '#000',
  },
});

export default HelpUsGrow;
