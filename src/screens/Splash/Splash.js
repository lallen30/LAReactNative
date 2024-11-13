import { Image, StyleSheet, Text, View } from 'react-native'
import React, { useEffect } from 'react'
import { images } from '../../resources/images'
import { useDispatch } from 'react-redux'
import { stayLoginAction } from '../../store/authSlice/auth.actions'

const Splash = () => {
    const dispatch = useDispatch();
    useEffect(() => {
        dispatch(stayLoginAction())
    }, [])
    return (
        <Image
            source={images.splash}
        />
    )
}

export default Splash

