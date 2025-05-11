from typing import Any, Text, Dict, List
from rasa_sdk import Action, Tracker
from rasa_sdk.events import UserUtteranceReverted
from rasa_sdk.executor import CollectingDispatcher

#cvh: thêm thông tin chi tiết từng giảng viên một 
TEACHER_INFO = {
    "Đỗ Thị Huyền": "Giảng viên Đỗ Thị Huyền chuyên dạy các môn cơ bản về Tin học và Công nghệ phần mềm. Với phương pháp giảng dạy dễ hiểu và sinh động, cô đã giúp nhiều sinh viên nắm vững kiến thức nền tảng và áp dụng vào thực tế. Cô cũng quản lý các học phần liên quan đến tin học đại cương và công nghệ phần mềm tại bộ môn CNPM.",
    "Lê Mai Nam": "Lê Mai Nam là chuyên gia trong các lĩnh vực Cấu trúc dữ liệu, Giải thuật và Phương pháp tính toán tối ưu. Với kinh nghiệm sâu rộng, giảng viên Nam luôn truyền cảm hứng học tập cho sinh viên qua các bài giảng thực tế, kết hợp lý thuyết và ứng dụng.",
    "Ngô Thùy Giang": "Cô Giang mang đến cho sinh viên trải nghiệm học tập sinh động qua các học phần về Đồ họa máy tính, Thiết kế Web và đặc biệt là Trí tuệ nhân tạo tạo sinh. Phong cách giảng dạy của cô cân bằng giữa tính kỹ thuật và tính thẩm mỹ, giúp sinh viên phát triển tư duy đa chiều.",
    "Lê Thùy Dung":"Giảng viên Lê Thùy Dung có kiến thức vững về Toán rời rạc và Lập trình hướng đối tượng với Java. Cô hướng tới việc giúp sinh viên phát triển tư duy logic và khả năng lập trình mạnh mẽ để giải quyết các bài toán phức tạp trong công nghệ phần mềm.",
    "Lê Trung Thực":"Thầy Thực phụ trách các học phần mang tính ứng dụng cao như Xử lý dữ liệu đa thành phần, Khai phá và phân tích dữ liệu, cùng Thực tập tốt nghiệp. Với lối giảng dạy sâu sắc và gần gũi, thầy giúp sinh viên kết nối lý thuyết với thực tế, chuẩn bị hành trang vững chắc trước khi ra trường.",
    "Lưu Thị Thảo":"Cô Thảo là người đồng hành cùng sinh viên từ những bước đầu lập trình đến các kiến thức chuyên sâu như Phân tích thiết kế hệ thống và Học máy. Cô luôn khuyến khích sinh viên phát triển khả năng tư duy hệ thống và cập nhật công nghệ mới, tạo nên môi trường học tập năng động và sáng tạo.",
    "Nguyễn Phồn Lữa":"Thầy Lữa chuyên sâu về lập trình Java và các ứng dụng của nó trong Trí tuệ nhân tạo. Với tinh thần cởi mở và cập nhật công nghệ liên tục, thầy truyền cảm hứng cho sinh viên theo đuổi các giải pháp sáng tạo và hiệu quả trong lập trình hiện đại.",
    "Nguyễn Thị Nga":"Cô Nga phụ trách nhiều học phần trọng yếu như Kiểm thử phần mềm, Quản lý dự án CNTT và Tiếng Anh chuyên ngành. Cô luôn đặt mục tiêu trang bị cho sinh viên cả kỹ năng chuyên môn lẫn kỹ năng mềm, nhằm đáp ứng yêu cầu của môi trường làm việc toàn cầu.",
    "Nguyễn Thị Thúy Nga":"Cô Thúy Nga đồng hành cùng sinh viên trong các học phần định hướng nghề nghiệp như Thực tập nhận thức và Đồ án chuyên ngành. Với sự tận tâm và khéo léo, cô giúp sinh viên hiểu rõ con đường phát triển của bản thân trong ngành Công nghệ phần mềm.",
    "Nguyễn Thu Hằng":"Chuyên môn của cô Hằng là Lập trình Web với PHP – một học phần vừa thực tiễn vừa thách thức. Cô chú trọng vào việc rèn luyện kỹ năng code sạch, tư duy logic và ứng dụng thực tế, nhằm giúp sinh viên làm chủ công cụ phát triển web phổ biến này.",
    "Trần Nguyên Hoàng":"Thầy Hoàng đảm nhận các học phần về lập trình .NET và ứng dụng công nghệ này trong Trí tuệ nhân tạo. Với khả năng kết nối giữa nền tảng lập trình truyền thống và công nghệ mới, thầy giúp sinh viên mở rộng tầm nhìn và khả năng thích ứng với các xu hướng kỹ thuật hiện đại.",
    "Mai Văn Linh":"Thầy Linh là người mở lối cho sinh viên bước vào lĩnh vực Khoa học dữ liệu thông qua học phần Nhập môn. Với cách tiếp cận dễ hiểu và thực tiễn, thầy giúp sinh viên xây dựng nền tảng vững chắc để khám phá sâu hơn trong lĩnh vực đầy tiềm năng này.",
    "Phạm Thị Loan":"Giảng viên Phạm Thị Loan chuyên dạy các môn cơ sở lập trình, đặc biệt là với ngôn ngữ C. Cô luôn tạo ra môi trường học tập thân thiện và dễ tiếp cận, giúp sinh viên nắm vững các nguyên lý lập trình cơ bản và phát triển kỹ năng lập trình vững chắc ngay từ những bước đầu tiên.",
    "Bùi Thanh Loan":"Với kinh nghiệm giảng dạy đa dạng, giảng viên Bùi Thanh Loan chuyên dạy các môn về Kiến trúc máy tính, Thương mại điện tử và Đồ án chuyên ngành HTTT. Cô mang đến một cách tiếp cận thực tế và dễ hiểu, giúp sinh viên chuẩn bị tốt cho những thử thách trong nghề nghiệp.",
    "Đặng Khánh Trung":"Giảng viên Đặng Khánh Trung là chuyên gia trong các lĩnh vực Công nghệ Blockchain, Quản trị hệ thống Windows Server và An toàn bảo mật thông tin. Thầy không chỉ chia sẻ kiến thức lý thuyết mà còn dẫn dắt sinh viên qua các bài tập thực hành để ứng dụng vào thực tế.",
    "Hà Trọng Thắng":"Giảng viên Hà Trọng Thắng chuyên giảng dạy các môn liên quan đến Hệ thống thông tin quản lý và các chuyên đề tốt nghiệp. Giảng viên Hà Trọng Thắng đặc biệt chú trọng vào việc phát triển kỹ năng nghiên cứu và tư duy phản biện của sinh viên, giúp họ hoàn thiện bài luận và đồ án tốt nghiệp.",
    "Hồ Anh Dũng":"Giảng viên Hồ Anh Dũng chuyên về các môn Hệ hỗ trợ ra quyết định và Khóa luận tốt nghiệp. Với kinh nghiệm sâu rộng trong lĩnh vực AI, Thầy giúp sinh viên hiểu và áp dụng các công nghệ mới vào việc giải quyết các bài toán thực tế trong ngành công nghệ thông tin.",
    "Lê Thị Huyền Trang":"Giảng viên Lê Thị Huyền Trang chuyên giảng dạy các môn về Hệ thống thông tin quản lý, Đồ án chuyên ngành và Tiếng Anh chuyên ngành HTTT. Cô luôn nỗ lực giúp sinh viên hiểu rõ cách áp dụng kiến thức vào thực tế, đồng thời rèn luyện khả năng giao tiếp chuyên môn hiệu quả.",
    "Nguyễn Đức Thiện (1980)":"Với kiến thức vững về Thiết kế và xây dựng hệ thống mạng doanh nghiệp, Mạng máy tính và Tiếng Anh chuyên ngành, giảng viên Nguyễn Đức Thiện giúp sinh viên nắm vững các kiến thức về mạng và hệ thống, đồng thời hỗ trợ trong việc phát triển các kỹ năng giao tiếp quốc tế.",
    "Nguyễn Hải Bình":"Giảng viên Nguyễn Hải Bình giảng dạy các môn Công nghệ đa phương tiện và Nguyên lý hệ điều hành. Cô đặc biệt chú trọng vào việc giúp sinh viên hiểu rõ cơ sở lý thuyết và áp dụng được vào thực tế trong các lĩnh vực công nghệ hiện đại.",
    "Nguyễn Hữu Phương":"Giảng viên Nguyễn Hữu Phương chuyên giảng dạy các môn về Lập trình mạng và Quản trị hệ thống Linux. Thầy luôn mang đến cho sinh viên một cái nhìn toàn diện về mạng và hệ thống, giúp sinh viên có thể ứng dụng kiến thức vào việc giải quyết các vấn đề thực tế trong ngành công nghệ.",
    "Ngô Thị Hoa":"Giảng viên Ngô Thị Hoa giảng dạy các môn về Khai phá dữ liệu và Trí tuệ nhân tạo. Cô giúp sinh viên không chỉ hiểu lý thuyết mà còn ứng dụng các công nghệ hiện đại để giải quyết các vấn đề phức tạp trong dữ liệu và AI.",
    "Nguyễn Đức Thiện (1984)":"Giảng viên Nguyễn Đức Thiện (84) chuyên dạy các môn về Dữ liệu lớn (Big Data), Lập trình ứng dụng với Python và Xử lý ngôn ngữ tự nhiên. Thầy tập trung vào việc giúp sinh viên hiểu và áp dụng các công cụ và kỹ thuật mới nhất trong lĩnh vực khoa học dữ liệu.",
    "Nguyễn Viết Hùng":"Giảng viên Nguyễn Viết Hùng chuyên dạy về Xử lý ảnh và thị giác máy tính, cùng với các môn học về Học sâu. Thầy luôn khuyến khích sinh viên sáng tạo và áp dụng các phương pháp mới nhất để giải quyết các bài toán liên quan đến thị giác máy tính và học máy.",
    "Trần Thị Thuý Hằng":"Giảng viên Trần Thị Thuý Hằng chuyên giảng dạy các môn về Cơ sở dữ liệu phân tán, Hệ quản trị CSDL với Oracle và Cơ sở dữ liệu. Cô chú trọng vào việc phát triển khả năng phân tích và thiết kế các hệ thống cơ sở dữ liệu phức tạp, đồng thời ứng dụng các công nghệ mới vào giảng dạy.",
    "Trần Xuân Thanh":"Giảng viên Trần Xuân Thanh giảng dạy các môn về Chuyên đề tốt nghiệp, Lập trình hướng đối tượng và Phát triển ứng dụng cho thiết bị di động. Thầy đặc biệt chú trọng vào việc giúp sinh viên phát triển kỹ năng lập trình và tạo ra các ứng dụng thực tế có giá trị trong ngành công nghệ.",
    # ... thêm các giảng viên khác ở đây
    "":"",
}

#cvh thêm lớp để xử lí các thông tin về từng giảng viên ở trên 
class ActionTraCuuThongTinGiangVien(Action):
    def name(self) -> Text:
        return "action_tra_cuu_thong_tin_giang_vien"

    def run(self, dispatcher: CollectingDispatcher,
            tracker: Tracker,
            domain: Dict[Text, Any]) -> List[Dict[Text, Any]]:

        teacher_name = tracker.get_slot("teacher_name")
        if teacher_name in TEACHER_INFO:
            dispatcher.utter_message(text=TEACHER_INFO[teacher_name])
        else:
            dispatcher.utter_message(text="Xin lỗi, tôi không tìm thấy thông tin giảng viên này.")

        return []


class ActionDefaultFallback(Action):
    def name(self) -> Text:
        return "action_default_fallback"

    async def run(
        self,
        tracker: Tracker,
        domain: Dict[Text, Any],
        dispatcher: CollectingDispatcher,
    ) -> List[Dict[Text, Any]]:
        dispatcher.utter_message(
            template="Xin lỗi, hiện tại tôi chưa hiểu ý bạn. Bạn có thể hỏi lại được không?"
        )

        # Revert user message which led to fallback.
        return [UserUtteranceReverted()]
