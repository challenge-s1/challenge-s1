import moment from 'moment';
export const formatDate  = function(value) {
  return moment(value).format('DD-MM-YYYY');
}

export const formatTime = function(value) {
  return moment(value).format('HH:mm');
}