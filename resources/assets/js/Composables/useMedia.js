"use strict"

export const useMedia = () => {
    return {
        profilePicture: (user, size = "thumb") => {
            if (user.profile_picture) {
                return {
                    large: user.profile_picture.responsive.large,
                    medium: user.profile_picture.responsive.medium,
                    small: user.profile_picture.responsive.small,
                    thumb: user.profile_picture.responsive.thumb,
                    original: user.profile_picture.url,
                }[size]
            } else {
                return user.default_profile_picture
            }
        },
    }
}
