import React, { useState, useEffect } from 'react';
import {
  View,
  Text,
  TouchableOpacity,
  Modal,
  FlatList,
  StyleSheet,
  GestureResponderEvent,
  Image,
} from 'react-native';
import { DownArrowBlue } from '../assets/images';

interface Option {
  heading: string;
  id: number;
}

interface CustomDropdownProps {
  options: Option[];
  onSelect: (selected: Option) => void;
  selectedLanguage: Option | null; // Add this prop to pass the selected language
}

const CustomDropdown: React.FC<CustomDropdownProps> = ({
  options,
  onSelect,
  selectedLanguage, // Destructure the selected language prop
}) => {
  const [selectedOption, setSelectedOption] = useState<Option>(
    selectedLanguage || options[0],
  );
  const [isDropdownVisible, setIsDropdownVisible] = useState<boolean>(false);

  useEffect(() => {
    // Update selected option if the selected language from the parent changes
    if (selectedLanguage) {
      setSelectedOption(selectedLanguage);
    }
  }, [selectedLanguage]);

  const handleSelectOption = (option: Option) => {
    setSelectedOption(option);
    onSelect(option);
    setIsDropdownVisible(false);
  };

  const toggleDropdown = (event: GestureResponderEvent) => {
    setIsDropdownVisible(!isDropdownVisible);
  };

  return (
    <View style={styles.container}>
      <TouchableOpacity style={styles.dropdown} onPress={toggleDropdown}>
        <Text style={styles.selectedText}>{selectedOption.heading}</Text>
        <Image source={DownArrowBlue} style={styles.arrow} />
      </TouchableOpacity>

      {isDropdownVisible && (
        <Modal
          transparent={true}
          animationType="fade"
          visible={isDropdownVisible}
          onRequestClose={() => setIsDropdownVisible(false)}>
          <TouchableOpacity
            style={styles.modalOverlay}
            onPress={() => setIsDropdownVisible(false)}>
            <View style={styles.dropdownList}>
              <FlatList
                data={options}
                renderItem={({ item }) => (
                  <TouchableOpacity
                    style={styles.option}
                    onPress={() => handleSelectOption(item)}>
                    <Text style={styles.optionText}>{item.heading}</Text>
                  </TouchableOpacity>
                )}
                keyExtractor={(item) => item.id.toString()}
              />
            </View>
          </TouchableOpacity>
        </Modal>
      )}
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    alignItems: 'center',
    paddingBottom: 20,
  },
  dropdown: {
    padding: 15,
    borderWidth: 1,
    borderColor: '#ccc',
    borderRadius: 5,
    width: '100%',
    backgroundColor: '#fff',
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
  },
  selectedText: {
    fontSize: 14,
    fontWeight: '400',
  },
  modalOverlay: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: 'rgba(0, 0, 0, 0.5)',
  },
  dropdownList: {
    width: '80%',
    backgroundColor: '#fff',
    borderRadius: 5,
    padding: 10,
  },
  option: {
    padding: 10,
    borderBottomWidth: 1,
    borderBottomColor: '#ccc',
  },
  optionText: {
    fontSize: 16,
    color: 'gray',
  },
  arrow: {
    height: 12,
    width: 12,
    objectFit: 'contain',
  },
});

export default CustomDropdown;
