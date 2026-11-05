import React, { useRef, useState, useEffect } from 'react';
import {
  ScrollView,
  View,
  Text,
  StyleSheet,
  TextInput,
  TouchableOpacity,
  Modal,
  FlatList,
  Image,
  KeyboardAvoidingView,
  Platform,
} from 'react-native';
import SecondaryPageHeader from '../components/SecondaryPageHeader';
import { globalStyles } from '../assets/styles/globalStyles';
import { fonts } from '../assets/fonts';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { addInternship, fetchIntershipOpportunity } from '../api/api';
import Toast from 'react-native-toast-message';
import { DownArrow, DownArrowBlue } from '../assets/images';

const InternshipScreen = () => {
  const refEmail = useRef();
  const refMobileNo = useRef();
  const refAboutYourself = useRef();
  const refGoals = useRef();
  const refMessage = useRef();

  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [mobile, setMobile] = useState('');
  const [aboutYourself, setAboutYourself] = useState('');
  const [goals, setGoals] = useState('');
  const [position, setPosition] = useState('');
  const [positionKey, setPositionKey] = useState('');
  const [message, setMessage] = useState('');
  const [isDropdownVisible, setDropdownVisible] = useState(false);
  const [positionsList, setPositionsList] = useState([]);
  // console.log('positionKey', positionKey);

  const [errors, setErrors] = useState({});

  useEffect(() => {
    const getIntershipOpportunity = async () => {
      try {
        const url = await AsyncStorage.getItem('baseUrl');

        if (url) {
          const response = await fetchIntershipOpportunity(url);
          setPositionsList(response.data.positions);
        } else {
          console.log('Base URL not found in AsyncStorage');
        }
      } catch (error) {
        console.log(
          'Error fetching base URL or getIntershipOpportunity: ',
          error,
        );
      }
    };

    getIntershipOpportunity();
  }, []);

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

    // VAlidation for goals
    if (!aboutYourself.trim()) {
      errors.aboutYourself = 'About Yourself is required';
    }

    // VAlidation for goals
    if (!goals.trim()) {
      errors.goals = 'Your goals is required';
    }
    // Validate message
    if (!message.trim()) {
      errors.message = 'Message is required';
    }
    // Validate position
    if (!position) {
      errors.position = 'Please select a position';
    }
    return errors;
  };

  const clearData = () => {
    setName('');
    setEmail('');
    setMobile('');
    setMessage('');
    setGoals('');
    setAboutYourself('');
    setPosition('');
    setErrors({});
  };

  const handleSelectPosition = (key, value) => {
    setPositionKey(key);
    setPosition(value);
    setDropdownVisible(false);
    setErrors((prevErrors) => ({ ...prevErrors, position: '' }));
  };

  const handleInternshipSubmit = async () => {
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
      position: positionKey,
      about: aboutYourself,
      goals: goals,
      message,
    };

    try {
      const url = await AsyncStorage.getItem('baseUrl');
      if (url) {
        const response = await addInternship(url, formData);
        // console.log('Internship', response);
        if (response.status === true) {
          Toast.show({
            type: 'success',
            position: 'bottom',
            text1: 'Success',
            text2: 'Your response has been sent successfully!',
          });
          clearData();
        } else {
          Toast.show({
            type: 'error',
            position: 'bottom',
            text1: 'Failed',
            text2: 'Failed to send response. Please try again later.',
          });
        }
      }
    } catch (error) {
      console.log('Error while adding Internship: ', error);
      Toast.show({
        type: 'error',
        position: 'bottom',
        text1: 'Error',
        text2: 'An error occurred. Please try again later.',
      });
    }
  };

  return (
    <KeyboardAvoidingView
      behavior={Platform.OS === 'ios' ? 'padding' : 'height'}>
      <ScrollView contentContainerStyle={globalStyles.bgWhite}>
        {/* Internship Header */}
        <SecondaryPageHeader
          title="Internship Opportunities"
          borderRadius={0}
        />
        {/* Internship Details */}
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
              Let's work{' '}
              <Text
                style={[
                  globalStyles.sectionTitleBlue,
                  globalStyles.textCenter,
                  globalStyles.mb12,
                ]}>
                Together!
              </Text>{' '}
            </Text>
            <Text style={styles.plainText}>Interested in an Internship?</Text>
            <Text style={styles.plainText}>
              Fill out some info and we will be in touch shortly!We can't wait
              to hear from you!
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
                  if (text) {
                    setErrors((prevErrors) => ({ ...prevErrors, mobile: '' }));
                  }
                }}
                onSubmitEditing={() => refAboutYourself.current.focus()}
              />
              {errors.mobile && (
                <Text style={styles.errorText}>{errors.mobile}</Text>
              )}

              <Text style={styles.label}>
                What positions are you interested in?
                <Text style={{ color: 'red' }}>*</Text>
              </Text>
              <TouchableOpacity onPress={() => setDropdownVisible(true)}>
                <View
                  style={[
                    styles.dropdown,
                    {
                      borderColor: errors.position ? 'red' : '#CFCFCF',
                      marginBottom: errors.position ? 5 : 15,
                    },
                  ]}>
                  <Text style={styles.dropdownText}>
                    {position ? position : 'Select a position'}
                  </Text>
                  <Image source={DownArrow} style={styles.arrow} />
                </View>
              </TouchableOpacity>
              {errors.position && (
                <Text style={styles.errorText}>{errors.position}</Text>
              )}

              {/* Dropdown Modal */}
              <Modal
                transparent={true}
                visible={isDropdownVisible}
                animationType="slide"
                onRequestClose={() => setDropdownVisible(false)}>
                <TouchableOpacity
                  style={styles.modalBackground}
                  onPress={() => setDropdownVisible(false)}>
                  <View style={styles.dropdownContainer}>
                    <Text style={[styles.dropdownText, { marginVertical: 5 }]}>
                      Select positions you are interested in ?
                    </Text>
                    {Object.entries(positionsList).map(([key, value]) => (
                      <TouchableOpacity
                        key={key}
                        style={styles.dropdownItem}
                        onPress={() => handleSelectPosition(key, value)}>
                        <Text style={styles.dropdownItemText}>{value}</Text>
                      </TouchableOpacity>
                    ))}
                  </View>
                </TouchableOpacity>
              </Modal>

              <Text style={styles.label}>
                Tell us about yourself<Text style={{ color: 'red' }}>*</Text>
              </Text>
              <TextInput
                ref={refAboutYourself}
                style={[
                  styles.input,
                  styles.textarea,
                  {
                    borderColor: errors.aboutYourself ? 'red' : '#CFCFCF',
                    marginBottom: errors.aboutYourself ? 5 : 15,
                  },
                ]}
                placeholder="Write here..."
                // returnKeyType="next"
                multiline={true}
                numberOfLines={4}
                value={aboutYourself}
                onChangeText={(text) => {
                  setAboutYourself(text);
                  if (text) {
                    setErrors((prevErrors) => ({
                      ...prevErrors,
                      aboutYourself: '',
                    }));
                  }
                }}
                onSubmitEditing={() => refGoals.current.focus()}
              />
              {errors.aboutYourself && (
                <Text style={styles.errorText}>{errors.aboutYourself}</Text>
              )}

              <Text style={styles.label}>
                What are your goals if given the position
                <Text style={{ color: 'red' }}>*</Text>
              </Text>
              <TextInput
                ref={refGoals}
                style={[
                  styles.input,
                  styles.textarea,
                  {
                    borderColor: errors.goals ? 'red' : '#CFCFCF',
                    marginBottom: errors.goals ? 5 : 15,
                  },
                ]}
                placeholder="Write here..."
                returnKeyType="next"
                multiline={true}
                numberOfLines={4}
                value={goals}
                onChangeText={(text) => {
                  setGoals(text);
                  if (text) {
                    setErrors((prevErrors) => ({ ...prevErrors, goals: '' }));
                  }
                }}
                onSubmitEditing={() => refMessage.current.focus()}
              />
              {errors.goals && (
                <Text style={styles.errorText}>{errors.goals}</Text>
              )}

              <Text style={styles.label}>
                Any Message To Us<Text style={{ color: 'red' }}>*</Text>
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
                placeholder="Write here..."
                // returnKeyType="done"
                multiline={true}
                numberOfLines={4}
                value={message}
                onChangeText={(text) => {
                  setMessage(text);
                  if (text) {
                    setErrors((prevErrors) => ({ ...prevErrors, message: '' }));
                  }
                }}
              />
              {errors.message && (
                <Text style={styles.errorText}>{errors.message}</Text>
              )}

              <TouchableOpacity
                onPress={() => {
                  handleInternshipSubmit();
                }}
                style={styles.button}>
                <Text style={styles.buttonText}>Submit</Text>
              </TouchableOpacity>
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
    lineHeight: 18,
    color: '#000',
    textAlign: 'center',
  },
  section: {
    backgroundColor: '#fff',
    padding: 16,
    borderRadius: 8,
    // marginBottom: 20,
    paddingBottom: 40,
  },
  detailsBlock: {
    backgroundColor: '#F0F5FF',
    padding: 16,
    borderRadius: 8,
    marginBottom: 12,
  },
  detailsRow: {
    flexDirection: 'row',
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
  errorText: {
    color: 'red',
    fontSize: 12,
    marginBottom: 8,
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
    width: 20,
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
  button: {
    backgroundColor: '#F5A623',
    paddingVertical: 10,
    paddingHorizontal: 25,
    borderRadius: 5,
    marginTop: 10,
  },
  buttonText: {
    color: 'white',
    fontSize: 14,
    textAlign: 'center',
    fontFamily: fonts.JakartaBold,
  },
  dropdown: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    borderWidth: 1,
    borderRadius: 5,
    padding: 10,
    paddingVertical: 14,
  },
  dropdownText: {
    fontSize: 15,
    color: '#828282',
    fontFamily: fonts.JakartaRegular,
  },
  modalBackground: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  dropdownContainer: {
    width: '80%',
    backgroundColor: '#fff',
    borderRadius: 5,
    padding: 10,
    elevation: 3,
  },
  dropdownItem: {
    padding: 10,
    borderBottomColor: '#CFCFCF',
  },
  dropdownItemText: {
    fontSize: 16,
    color: '#000',
  },
  arrow: {
    height: 12,
    width: 12,
    right: 5,
    top: 7,
    objectFit: 'contain',
  },
});

export default InternshipScreen;
