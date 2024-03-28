export default function DateConvert(str, includeHour) {
  const date = new Date(str);

  var options = includeHour
    ? {
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "numeric",
        minute: "numeric",
      }
    : { year: "numeric", month: "long", day: "numeric" };

  return date.toLocaleDateString("pt-BR", options);
}
