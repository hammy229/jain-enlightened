import React, { useEffect, useRef, useState } from 'react';
import {
  ScrollView,
  View,
  Text,
  Image,
  StyleSheet,
  TextInput,
  Pressable,
  KeyboardAvoidingView,
} from 'react-native';
import SecondaryPageHeader from '../components/SecondaryPageHeader';
import { globalStyles } from '../assets/styles/globalStyles';
import { fonts } from '../assets/fonts';
import {
  Call,
  Email,
  Facebook,
  Instagram,
  Linkedin,
  Location,
  Send,
  Youtube,
} from '../assets/images';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { addContactUs, fetchContactUsDetails } from '../api/api';
import Toast from 'react-native-toast-message';
import Loader from '../components/Loader';
import { handleLink } from '../utils';

const ContactScreen = () => {
  const refEmail = useRef();
  const refMobileNo = useRef();
  const refMessage = useRef();
  const [contactDetails, setContactDetails] = useState();
  const [loading, setLoading] = useState(true);

  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [mobile, setMobile] = useState('');
  const [message, setMessage] = useState('');

  const [errors, setErrors] = useState({});

  useEffect(() => {
    const getContactDetails = async () => {
      try {
        const url = await AsyncStorage.getItem('baseUrl');

        if (url) {
          const response = await fetchContactUsDetails(url);
          setContactDetails(response);
        } else {
          console.log('Base URL not found in AsyncStorage');
        }
      } catch (error) {
        console.log('Error fetching contact details: ', error);
      } finally {
        setLoading(false);
      }
    };

    getContactDetails();
  }, []);

  if (loading) {
    return <Loader />;
  }

  const clearData = () => {
    setName('');
    setEmail('');
    setMobile('');
    setMessage('');
    setErrors({});
  };

  const validate = () => {
    const errors = {};

    // Validate name
    if (!name) {
      errors.name = 'Name is required';
    }

    // Validate email
    if (!email) {
      errors.email = 'Email is required';
    } else if (!/\S+@\S+\.\S+/.test(email)) {
      errors.email = 'Email address is invalid';
    }

    // Validate mobile number
    if (!mobile) {
      errors.mobile = 'Mobile number is required';
    } else if (!/^\d{10}$/.test(mobile)) {
      // Assuming mobile number should be 10 digits
      errors.mobile = 'Mobile number must be 10 digits';
    }

    // Validate message
    if (!message.trim()) {
      errors.message = 'Message is required';
    }

    return errors;
  };

  const handleContactUsSubmit = async () => {
    const validationErrors = validate();

    // If there are validation errors, update the state and return
    if (Object.keys(validationErrors).length > 0) {
      setErrors(validationErrors);
      return;
    }

    // Clear previous errors
    setErrors({});

    const formData = {
      name,
      email,
      mobile,
      message,
    };

    try {
      const url = await AsyncStorage.getItem('baseUrl');
      if (url) {
        const response = await addContactUs(url, formData);
        console.log('contactUs', response);
        if (response.status === true) {
          Toast.show({
            type: 'success',
            position: 'top',
            text1: 'Success',
            text2: 'Your message has been sent successfully!',
          });
          clearData();
        } else {
          Toast.show({
            type: 'error',
            position: 'top',
            text1: 'Failed',
            text2: 'Failed to send message. Please try again later.',
          });
        }
      }
    } catch (error) {
      console.log('Error while adding contactUs sdf: ', error);
      Toast.show({
        type: 'error',
        position: 'top',
        text1: 'Error',
        text2: 'An error occurred. Please try again later.',
      });
    }
  };

  return (
    <KeyboardAvoidingView
      behavior={Platform.OS === 'ios' ? 'padding' : 'height'}>
      <ScrollView contentContainerStyle={globalStyles.bgWhite}>
        {/* Help Us Grow Header */}
        <SecondaryPageHeader title="Contact Us" borderRadius={0} />
        {/* Help Us Details */}
        <View
          style={[globalStyles.padHorizontal, globalStyles.headerThree]}></View>

        <View style={globalStyles.layoutThreeBox}>
          <View style={[styles.section, globalStyles.cardShadow]}>
            <Text
              style={[
                globalStyles.sectionTitleBlack,
                globalStyles.textCenter,
                globalStyles.mb12,
              ]}>
              Drop Us{' '}
              <Text
                style={[
                  globalStyles.sectionTitleBlue,
                  globalStyles.textCenter,
                  globalStyles.mb12,
                ]}>
                A Line!
              </Text>{' '}
            </Text>
            <Text style={styles.plainText}>
              Please fill out the form below to get in touch with us. We'll get
              back to you as soon as possible.
            </Text>
            <View style={{ marginTop: 16 }}>
              <Text style={styles.label}>
                Name<Text style={{ color: 'red' }}>*</Text>
              </Text>
              <TextInput
                style={[
                  styles.input,
                  {
                    borderColor: errors.name ? 'red' : '#CFCFCF',
                    marginBottom: errors.name ? 5 : 15,
                  },
                ]}
                placeholder="Enter your full name"
                returnKeyType="next"
                value={name}
                onChangeText={(text) => {
                  setName(text);
                  // Clear the error message when the user starts typing
                  if (text) {
                    setErrors((prevErrors) => ({ ...prevErrors, name: '' }));
                  }
                }}
                onSubmitEditing={() => refEmail.current.focus()}
              />
              {errors.name && (
                <Text style={styles.errorText}>{errors.name}</Text>
              )}

              <Text style={styles.label}>
                Email ID<Text style={{ color: 'red' }}>*</Text>
              </Text>
              <TextInput
                ref={refEmail}
                style={[
                  styles.input,
                  {
                    borderColor: errors.email ? 'red' : '#CFCFCF',
                    marginBottom: errors.email ? 5 : 15,
                  },
                ]}
                placeholder="Enter email Id"
                keyboardType="email-address"
                returnKeyType="next"
                value={email}
                onChangeText={(text) => {
                  setEmail(text);
                  // Clear the error message when the user starts typing
                  if (text) {
                    setErrors((prevErrors) => ({ ...prevErrors, email: '' }));
                  }
                }}
                onSubmitEditing={() => refMobileNo.current.focus()}
              />
              {errors.email && (
                <Text style={styles.errorText}>{errors.email}</Text>
              )}

              <Text style={styles.label}>
                Mobile Number<Text style={{ color: 'red' }}>*</Text>
              </Text>
              <TextInput
                ref={refMobileNo}
                style={[
                  styles.input,
                  {
                    borderColor: errors.mobile ? 'red' : '#CFCFCF',
                    marginBottom: errors.mobile ? 5 : 15,
                  },
                ]}
                placeholder="Enter mobile number"
                keyboardType="phone-pad"
                returnKeyType="next"
                value={mobile}
                onChangeText={(text) => {
                  setMobile(text);
                  // Clear the error message when the user starts typing
                  if (text) {
                    setErrors((prevErrors) => ({ ...prevErrors, mobile: '' }));
                  }
                }}
                onSubmitEditing={() => refMessage.current.focus()}
              />
              {errors.mobile && (
                <Text style={styles.errorText}>{errors.mobile}</Text>
              )}

              <Text style={styles.label}>
                Message<Text style={{ color: 'red' }}>*</Text>
              </Text>
              <TextInput
                ref={refMessage}
                style={[
                  styles.input,
                  styles.textarea,
                  {
                    borderColor: errors.message ? 'red' : '#CFCFCF',
                    marginBottom: errors.message ? 5 : 15,
                  },
                ]}
                placeholder="Enter your message"
                multiline={true}
                numberOfLines={4}
                // returnKeyType="done"
                value={message}
                onChangeText={(text) => {
                  setMessage(text);
                  // Clear the error message when the user starts typing
                  if (text) {
                    setErrors((prevErrors) => ({ ...prevErrors, message: '' }));
                  }
                }}
              />
              {errors.message && (
                <Text style={styles.errorText}>{errors.message}</Text>
              )}
            </View>
            <Pressable
              onPress={() => {
                handleContactUsSubmit();
              }}
              style={styles.submitButton}>
              <Image source={Send} style={styles.submitIcon} />
            </Pressable>
          </View>
          <View style={{ marginBottom: 16 }}>
            <Text
              style={[
                globalStyles.sectionTitleBlack,
                globalStyles.textCenter,
                globalStyles.mb12,
              ]}>
              Welcome to{' '}
              <Text
                style={[
                  globalStyles.sectionTitleBlue,
                  globalStyles.textCenter,
                  globalStyles.mb12,
                ]}>
                JainEnlightened!
              </Text>{' '}
            </Text>
            <Text style={styles.plainText}>{contactDetails?.description}</Text>
          </View>
          <View style={{ marginBottom: 24 }}>
            <View style={[styles.detailsRow, styles.detailsBlock]}>
              <Pressable
                onPress={() => handleLink(`mailto:${contactDetails?.email}`)}
                style={styles.detailIconBox}>
                <Image source={Email} style={styles.detailIcon} />
              </Pressable>
              <View style={globalStyles.flex1}>
                <Text style={styles.detailLabel}>Email</Text>
                <Text style={styles.detailValue}>{contactDetails?.email}</Text>
              </View>
            </View>
            <View style={[styles.detailsRow, styles.detailsBlock]}>
              <Pressable
                onPress={() => handleLink(`tel:${contactDetails?.mobile}`)}
                style={styles.detailIconBox}>
                <Image source={Call} style={styles.detailIcon} />
              </Pressable>
              <View style={globalStyles.flex1}>
                <Text style={styles.detailLabel}>Contact Number</Text>
                <Text style={styles.detailValue}>{contactDetails?.mobile}</Text>
              </View>
            </View>
            <View style={[styles.detailsRow, styles.detailsBlock]}>
              <Pressable
                onPress={() => handleLink(`tel:${contactDetails?.map_link}`)}
                style={styles.detailIconBox}>
                <Image source={Location} style={styles.detailIcon} />
              </Pressable>
              <View style={globalStyles.flex1}>
                <Text style={styles.detailLabel}>Address</Text>
                <Text style={styles.detailValue}>
                  {contactDetails?.address}
                </Text>
              </View>
            </View>
          </View>

          <View>
            <Text
              style={[
                globalStyles.sectionTitleBlack,
                globalStyles.textCenter,
                globalStyles.mb12,
              ]}>
              Follow{' '}
              <Text
                style={[
                  globalStyles.sectionTitleBlue,
                  globalStyles.textCenter,
                  globalStyles.mb12,
                ]}>
                Us On
              </Text>{' '}
            </Text>
            <View style={styles.socialContainer}>
              {contactDetails?.instagram_url && (
                <Pressable
                  onPress={() => handleLink(contactDetails?.instagram_url)}
                  style={styles.socialShadow}>
                  <Image source={Instagram} style={styles.socialIcons} />
                </Pressable>
              )}
              {contactDetails?.facebook_url && (
                <Pressable
                  onPress={() => handleLink(contactDetails?.facebook_url)}
                  style={styles.socialShadow}>
                  <Image source={Facebook} style={styles.socialIcons} />
                </Pressable>
              )}
              {contactDetails?.linkedin_url && (
                <Pressable
                  onPress={() => handleLink(contactDetails?.linkedin_url)}
                  style={styles.socialShadow}>
                  <Image source={Linkedin} style={styles.socialIcons} />
                </Pressable>
              )}
              {contactDetails?.youtube_url && (
                <Pressable
                  onPress={() => handleLink(contactDetails?.youtube_url)}
                  style={styles.socialShadow}>
                  <Image source={Youtube} style={styles.socialIcons} />
                </Pressable>
              )}
            </View>
          </View>
        </View>
        <Toast ref={(ref) => Toast.setRef(ref)} />
      </ScrollView>
    </KeyboardAvoidingView>
  );
};

const styles = StyleSheet.create({
  plainText: {
    fontFamily: fonts.JakartaRegular,
    fontSize: 13,
    color: '#000',
    lineHeight: 18,
    textAlign: 'center',
  },
  errorText: {
    color: 'red',
    fontSize: 12,
    marginBottom: 8,
  },
  section: {
    backgroundColor: '#fff',
    padding: 16,
    borderRadius: 8,
    marginBottom: 80,
    paddingBottom: 60,
  },
  detailsBlock: {
    backgroundColor: '#F0F5FF',
    padding: 16,
    borderRadius: 8,
    marginBottom: 12,
  },
  detailsRow: {
    flexDirection: 'row',
    alignItems: 'center',
    marginBottom: 8,
    gap: 12,
  },
  detailLabel: {
    fontSize: 14,
    fontFamily: fonts.JakartaBold,
    color: '#167E98',
  },
  detailValue: {
    fontSize: 12,
    fontFamily: fonts.JakartaMedium,
    color: '#000',
  },
  detailIconBox: {
    backgroundColor: '#DAE3F4',
    height: 45,
    width: 45,
    borderRadius: 4,
    justifyContent: 'center',
    alignItems: 'center',
  },
  detailIcon: {
    height: 24,
    width: 24,
    objectFit: 'contain',
  },
  label: {
    fontSize: 12,
    fontFamily: fonts.JakartaBold,
    color: '#167E98',
    marginBottom: 5,
  },
  input: {
    borderWidth: 1,
    borderRadius: 5,
    padding: 10,
    fontSize: 15,
    color: '#828282',
    fontFamily: fonts.JakartaRegular,
  },
  textarea: {
    height: 100,
    textAlignVertical: 'top',
  },
  submitButton: {
    backgroundColor: '#167E98',
    borderRadius: 100,
    justifyContent: 'center',
    alignItems: 'center',
    position: 'absolute',
    bottom: -40,
    alignSelf: 'center',
    width: 80,
    height: 80,
    elevation: 5,
  },
  submitIcon: {
    height: 40,
    width: 40,
    objectFit: 'contain',
    marginRight: 4,
  },
  socialIcons: {
    height: 25,
    width: 25,
    objectFit: 'contain',
    tintColor: '#167E98',
  },
  socialShadow: {
    shadowColor: '#000',
    shadowOffset: {
      width: 0,
      height: 1,
    },
    shadowOpacity: 0.2,
    shadowRadius: 1.41,

    elevation: 2,
    backgroundColor: '#fff',
    height: 45,
    width: 45,
    borderRadius: 50,
    justifyContent: 'center',
    alignItems: 'center',
  },
  socialContainer: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 10,
    alignSelf: 'center',
  },
});

export default ContactScreen;
