import { StyleSheet } from 'react-native';
import { fonts } from '../fonts';

export const globalStyles = StyleSheet.create({
  padHorizontal: {
    paddingHorizontal: 15,
  },
  padVertical: {
    paddingVertical: 20,
  },
  navBtnContainer: {
    backgroundColor: '#00000036',
    borderRadius: 8,
    justifyContent: 'center',
    alignItems: 'center',
    height: 45,
    width: 45,
  },
  overlay: {
    position: 'absolute',
    top: 0,
    left: 0,
    right: 0,
    bottom: 0,
  },
  bgWhite: {
    backgroundColor: '#fff',
  },
  cardShadow: {
    backgroundColor: '#fff',
    shadowColor: '#000',
    shadowOffset: {
      width: 0,
      height: 2,
    },
    shadowOpacity: 0.25,
    shadowRadius: 3.84,

    elevation: 5,
  },
  headerThree: {
    backgroundColor: '#1D515E',
    borderBottomLeftRadius: 14,
    borderBottomRightRadius: 14,
    paddingBottom: 70,
  },
  layoutThreeBox: {
    transform: [{ translateY: -50 }],
    paddingHorizontal: 15,
  },
  sectionTitleBlack: {
    fontSize: 18,
    color: '#303030',
    fontFamily: fonts.JakartaSemiBold,
    lineHeight: 20,
  },
  sectionTitleBlue: {
    fontSize: 18,
    color: '#167E98',
    fontFamily: fonts.JakartaExtraBold,
    lineHeight: 24,
  },
  textCenter: {
    textAlign: 'center',
  },
  mb12: {
    marginBottom: 12,
  },
  rightArrowBtn: {
    flexDirection: 'row',
    alignItems: 'baseline',
    gap: 6,
  },
  rightArrowBtnTextBlack: {
    fontSize: 13,
    fontWeight: '600',
    fontFamily: fonts.OpenSansSemiBold,
  },
  rightArrowBtnArrow: {
    height: 9,
    width: 8,
    objectFit: 'contain',
  },
  noDataText: {
    textAlign: 'center',
    color: '#0D677D',
    marginTop: 20,
  },
  flex1: {
    flex: 1,
  },
});
