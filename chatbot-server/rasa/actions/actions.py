from typing import Any, Text, Dict, List
from rasa_sdk import Action, Tracker
from rasa_sdk.events import UserUtteranceReverted
from rasa_sdk.executor import CollectingDispatcher

#6. Sau khi xong các bước trên sang đây điền dữ liệu các môn họchọc như ở bên dưới
MON_HOC_INFO = {
    "Phân tích thiết kế hệ thống": {
        "mã học phần": "IT3225",
        "số tín chỉ": "3 (3, 0, 0, 0)",
        "giảng viên": "Đỗ Thị Huyền, Lê Trung Thực, Trần Nguyên Hoàng...",
        "mô tả": "Học phần giúp sinh viên hiểu quy trình phân tích, thiết kế hệ thống thông tin, áp dụng xây dựng và triển khai các hệ thống vừa và nhỏ."
    },
    "Đồ án tốt nghiệp": {
        "mã học phần": "IT4238",
        "số tín chỉ": "9 (9, 0, 0, 0)",
        "giảng viên": "Lê Trung Thực, Đỗ Thị Huyền, Nguyễn Thị Nga...",
        "mô tả": "Sinh viên áp dụng toàn bộ kiến thức đã học để thực hiện một dự án CNTT hoàn chỉnh, nộp báo cáo và bảo vệ trước hội đồng."
    },
    "Thực tập tốt nghiệp": {
        "mã học phần": "IT4237",
        "số tín chỉ": "3 (1, 0, 0, 2)",
        "giảng viên": "Lê Trung Thực, Phạm Thị Loan...",
        "mô tả": "Sinh viên tham gia thực tập tại doanh nghiệp, học cách ứng dụng kỹ năng thực tế và viết báo cáo thu hoạch theo yêu cầu."
    },
     "Toán rời rạc": {
        "mã học phần": "MI1213",
        "số tín chỉ": "2 (2,0,0,0)",
        "giảng viên": "Lê Mai Nam, Trần Xuân Thanh, Nguyễn Thị Nga..",
        "mô tả": "Sinh viên sau khi hoàn thành học phần này sẽ: Có khả năng phân tích chia nhỏ bài toán thực tế lớn thành các bài toán thực tế nhỏ hơn. Chuyển các bài toán thực tế thành những bài toán toán học dưới dạng công thức. Sử dụng thuật toán để giải quyết các bài toán."
    },
         "Kiểm thử phần mềm": {
        "mã học phần": "IT3240",
        "số tín chỉ": "3 (2,1,0,0)   ",
        "giảng viên": "Đoàn Thị Thuỳ Linh, Nguyễn Thị Nga, Lưu Thị Thảo,...",
        "mô tả": "Học phần Kiểm thử phần mềm là học phần thuộc khối kiến thức chuyên ngành Công nghệ phần mềm. Học phần này cung cấp cho sinh viên kiến thức về kiểm thử phần mềm, các quy trình kiểm thử phần mềm, các kỹ thuật cơ bản trong phân tích và thiết kế test case, thực hiện kiểm thử và báo cáo kết quả kiểm thử. Ngoài ra, học phần này cũng cung cấp sự hiểu biết và cách sử dụng một số công cụ hỗ trợ quản lý lỗi, một số công cụ hỗ trợ kiểm thử tự động. Bên cạnh đó, sinh viên được làm việc trong các nhóm và thuyết trình các vấn đề nâng cao sử dụng các phương tiện trình chiếu. Sau khi học xong học phần này sinh viên có khả năng kiểm thử và đánh giá chất lượng một phần mềm cụ thể trong thực tế."
    },
         "Cơ sở lập trình với C": {
        "mã học phần": "IT2201",
        "số tín chỉ": "3 (2,1,0,0)   ",
        "giảng viên": "Mai Văn Linh, Lưu Thị Thảo",
        "mô tả": "Học phần Cơ sở lập trình với C là học phần thuộc khối kiến thức cơ sở ngành của ngành Công nghệ thông tin. Học phần giúp cho sinh viên hiểu rõ các khái niệm cơ bản về thuật toán (giải thuật) và các cấu trúc chương trình. Các khái niệm cơ bản; các kiểu dữ liệu; các câu lệnh vào - ra dữ liệu; các cấu trúc điều khiển; hàm; con trỏ; kiểu cấu trúc trong ngôn ngữ C. Sau khi học xong học phần này người học có khả năng sử dụng được các kĩ thuật lập trình và ngôn ngữ lập trình C để lập trình những bài toán cơ bản, đơn giản."
    },
         "Kỹ thuật đồ họa máy tính": {
        "mã học phần": "IT13236",
        "số tín chỉ": "3 (2, 1, 0, 0)",
        "giảng viên": "Ngô Thùy Giang, Nguyễn Hải Bình, Lê Mai Nam,...",
        "mô tả": "Học phần Kỹ thuật đồ họa máy tính là học phần thuộc khối kiến thức chuyên ngành của ngành Công nghệ thông tin. Học phần cung cấp cho sinh viên những kiến thức tổng quan về đồ hoạ máy tính, các phương pháp, giải thuật kiến tạo đồ hoạ. Sau khi học xong học phần này người học có khả năng:- Hiểu biết về các ứng dụng thực tế của đồ họa máy tính trong các lĩnh vực cuộc sống.- Nắm được các phương pháp, thành phần, nguyên lý của giải thuật tạo dựng và xử lý một đối tượng đồ hoạ trên máy tính.- Xây dựng các đối tượng đồ hoạ dựa trên các thuật toán.- Thiết kế các hình ảnh đồ hoạ với thư viện đồ họa OpenGL và ngôn ngữ lập trình C++.- Giải quyết các bài toán đồ hoạ ứng dụng trong việc mô phỏng thế giới thực."
    },
         "Thiết kế web": {
        "mã học phần": "IT2203",
        "số tín chỉ": "3 (2,1,0,0)  ",
        "giảng viên": "Ngô Thùy Giang, Trần Nguyên Hoàng, Đỗ Thị Huyền ",
        "mô tả": "Học phần Thiết kế web là học phần thuộc khối kiến thức cơ sở ngành Công nghệ phần mềm. Học phần mô tả những kiến thức cơ bản và nâng cao về thiết kế web:- Giới thiệu các kiến thức cơ bản về internet, web; những khái niệm cơ bản về cấu trúc một website và các nguyên tắc thiết kế web.- Cung cấp những kiến thức cơ bản trong việc thiết kế website sử dụng công nghệ  HTML5, CSS3, Javascript- Tiếp cận các kiến thức cơ bản và nâng cao về thiết kế layout, sử dụng những kĩ thuật tiên tiến nhất của HTML5, CSS3 và kỹ thuật lập trình Javascript."
    },
         "Công nghệ Java": {
        "mã học phần": "IT3242",
        "số tín chỉ": "4 (3,1,0,0)",
        "giảng viên": "Trần Xuân Thanh, Trần Nguyên Hoàng, Nguyễn Đức Thiện,...",
        "mô tả": "Học phần Công nghệ Java là học phần thuộc khối kiến thức chuyên ngành. Học phần giúp sinh viên hiểu rõ kiến thức về các công nghệ trong hệ sinh thái Java. Định hướng cho sinh viên trong việc thiết kế và phát triển các sản phẩm phần mềm, webstie trên nền tảng công nghệ Java. Cung cấp cho sinh viên kiến thức cơ bản về ngôn ngữ lập trình Java. Giúp sinh viên có khả năng thiết kế, phát triển và bảo trì các ứng dụng Java độc lập và ứng dụng web. Nâng cao kỹ năng tư duy logic và giải quyết vấn đề cho sinh viên. Rèn luyện kỹ năng làm việc độc lập và làm việc nhóm cho sinh viên"
    },
         "Phát triển ứng dụng cho thiết bị di động": {
        "mã học phần": "IT2205",
        "số tín chỉ": "4 (3,1,0,0)",
        "giảng viên": "Trần Xuân Thanh, Trần Nguyên Hoàng, Nguyễn Đức Thiện,...",
        "mô tả": "Học phần Phát triển ứng dụng cho thiết bị di động là học phần thuộc khối kiến thức chuyên ngành. Học phần giúp sinh viên hiểu rõ về cấu trúc hệ điều hành Android và các bước phát triển một ứng dung trên nên tảng Android cho các thiết bị di động."
    },
         "Lập trình web với PHP": {
        "mã học phần": "IT3220",
        "số tín chỉ": "4 (3,1,0,0)  ",
        "giảng viên": "Mai Văn Linh, Nguyễn Đức Thiện (84), Đỗ Thị Huyền,...",
        "mô tả": "Học phần Lập trình web với PHP là học phần thuộc khối kiến thức chuyên ngành, học phần giúp học sinh hiểu rõ các bước xây dựng một web site, sử dụng thành thạo được ngôn ngữ lập trình PHP để tạo ra một ứng dụng website và triển khai trên môi trường trực tuyến. Về kiến thức: Hiểu được các nguyên lý về thiết kế  Web với HTML, định dạng website với CSS, Javascript; Có kiến thức về ngôn ngữ lập trình PHP. Về kỹ năng: Thành thạo cơ bản lập trình website quản lý bán hàng trên website với csdl mysql. Năng lực tự chủ và trách nhiệm: Nghiêm túc, trách nhiệm, chủ động, tích cực, chăm chỉ, cẩn thận và cần có thái độ tự nghiên cứu học hỏi cao."
    },
         "Cấu trúc dữ liệu và giải thuật": {
        "mã học phần": "IT2207",
        "số tín chỉ": "3 (2,1,0,0)  ",
        "giảng viên": "Trần Nguyên Hoàng",
        "mô tả": "Học phần được giảng dạy năm thứ 2 giúp sinh viên thực sự hiểu được tầm quan trọng của giải thuật và cấu trúc dữ liệu - hai thành tố quan trọng của một chương trình; các kiểu cấu trúc dữ liệu thông dụng và các giải thuật trên các cấu trúc dữ liệu ấy."
    },
         "Công nghệ phần mềm": {
        "mã học phần": "IT3226",
        "số tín chỉ": "2 (A,B,C,D)  ",
        "giảng viên": "",
        "mô tả": "Học phần Công nghệ phần mềm là học phần thuộc khối kiến thức chuyên ngành Công nghệ phần mềm. Học phần giúp sinh viên nắm được những Các nguyên lý cơ bản trong kỹ thuật phần mềm trên ba lĩnh vực yêu cầu, thiết kế và kiểm tra; Kỹ thuật phân tích dựa trên sơ đồ dòng dữ liệu (DFD); Các phân tích hướng đối tượng sử dụng UML; Các mô hình phát triển phần mềm; Kiểm tra đánh giá hệ thống; Quản trị và ước lượng dự án. "
    },
         "Phương pháp tính toán tối ưu": {
        "mã học phần": "IT2209",
        "số tín chỉ": "2 (2,0,0,0)",
        "giảng viên": "Lê Mai Nam, Lê Trung Thực, Trần Xuân Thanh,...",
        "mô tả": "Mục tiêu: Sau khi hoàn thành học phần này, sinh viên có khả năng: Nắm được các thuật toán giải quyết các bài toán quy hoạch, bài toán vận tải, bài toán quy hoạch động và một số mô hình lý thuyết điều khiển dự trữ. Cài đặt được các thuật toán đề cập trong phần trên. Đánh giá các thuật toán, kỹ thuật giải quyết bài toán kể trên. Thiết kế được các thuật toán, giải pháp, để giải quyết các bài toán liên quan. Giải quyết các bài toán dựa trên cơ sở các bài toán đã giải quyết được liệt kê trong phần trên. Nội dung: Học phần cung cấp cho sinh viên những kiến thức tổng quan về phương pháp tính toán tối ưu, các giải thuật giải quyết các bài toán. "
    },
         "Lập trình hướng đối tượng với Java": {
        "mã học phần": "IT3219",
        "số tín chỉ": "3 (2,1,0,0) ",
        "giảng viên": "Trần Nguyên Hoàng",
        "mô tả": "Cung cấp cho sinh viên kiến thức về phương pháp lập trình hướng đối tượng, một phương pháp rất phổ biến hiện nay. Định hướng cho sinh viên trong việc thiết kế một chương trình theo phương pháp hướng đối tượng, sử dụng các khái niệm như kiểu dữ liệu trừu tượng, nguyên tắc kế thừa trong việc phát triển các kiểu dữ liệu, tính đa hình"
    },
         "Lập trình .NET": {
        "mã học phần": "IT3212",
        "số tín chỉ": "4 (2,2,0,0)  ",
        "giảng viên": "Trần Nguyên Hoàng",
        "mô tả": "Học phần được giảng dạy năm thứ 2 giúp sinh viên thực sự hiểu được tầm quan trọng của giải thuật và cấu trúc dữ liệu - hai thành tố quan trọng của một chương trình; các kiểu cấu trúc dữ liệu thông dụng và các giải thuật trên các cấu trúc dữ liệu ấy."
    },
         "Thực tập nhận thức ngành nghề": {
        "mã học phần": "IT2208",
        "số tín chỉ": "2 (2,0,0,0)",
        "giảng viên": "Nguyễn Thị Thúy Nga",
        "mô tả": "Nhận thức rõ về chương trình đào tạo ngành CNTT trường ĐHCNĐA. Nhận thức tốt vể nhập môn ngành CNTT trường ĐHCNĐA. Hình thành nhận thức cơ bản về môi trường làm việc, lĩnh vực hoạt động của ngành công nghệ thông tin, nền tảng cho tác phong quy cách làm việc và một số kỹ năng làm việc cơ bản, như: liên quan tới CNTT, cách thức biểu diễn dữ liệu trong máy tính và hệ đếm, tổng quan về lập trình; Cơ sở dữ liệu, quản trị dữ liệu và  Hệ thống thông tin quản lý.  Xây dựng các mối quan hệ trong công việc tại các tổ chức, doanh nghiệp. Rèn luyện tác phong làm việc, kỹ năng, năng lực làm việc chuyên nghiệp, độc lập và sáng tạo. Định hướng nghề nghiệp, định hướng kế hoạch học tập và phát triển bản thân."
    },
         "Quản lý dự án CNTT": {
        "mã học phần": "IT3230",
        "số tín chỉ": "2 (2,0,0,0)   ",
        "giảng viên": "",
        "mô tả": "Học phần Quản lý dự án CNTT là học phần thuộc khối kiến thức chuyên ngành Công nghệ phần mềm. Nội dung học phần bao gồm kiến thức cơ bản về Quản lý dự án Công nghệ Thông tin (QLDA CNTT) như: Dự án, Quản lý dự án CNTT, vai trò của người tham gia dự án, vòng đời của dự án, bối cảnh và xu hướng mới ảnh hưởng đến dự án CNTT. Trình bày về các giai đoạn quản lý dự án CNTT, các lĩnh vực hoạt động trong quản lý dự án như: QL tích hợp, QL phạm vi, QL thời gian, QL chi phí, QL chất lượng, QL nhân lực, QL thông tin và truyền thông."
    },
         "Tiếng anh chuyên ngành công nghệ phần mềm": {
        "mã học phần": "IT3239",
        "số tín chỉ": "2(2,0,0,0)",
        "giảng viên": "",
        "mô tả": "The module provides the following knowledge and skills: Understanding of the field of software engineering in general and application software in particular. Basic knowledge of programming languages, classification of programming languages ​​in the information technology industry. Basic computer networks and the Internet. Provides an overview of IT industry jobs and the people who work in. This module presents topics about three main areas in Information Technology: Computer Software, Networking and IT Careers."
    },
             "Đồ án chuyên ngành công nghệ phần mềm": {
        "mã học phần": "IT3228",
        "số tín chỉ": "5 (1, 0, 4, 0)",
        "giảng viên": "Đỗ Thị Huyền, Lê Trung Thực, Nguyễn Thị Thúy Nga,...",
        "mô tả": "Học phần Đồ án chuyên ngành công nghệ phần mềm là học phần thuộc khối kiến thức chuyên ngành Công nghệ phần mềm. Học phần giúp người học vận dụng được các kiến thức đã học trong phân tích thiết kế hệ thống; phân tích, thiết kế CSDL quan hệ; các ngôn ngữ lập trình giải quyết các yêu cầu của bài toán trong thực tế. Sau khi học xong học phần này người học có khả năng Phân tích và thiết kế một hệ thống trong thực tế, đưa ra được giải pháp về nghiệp vụ và lựa chọn được công nghệ phù hợp để giải quyết được các yêu cầu của bài toán đã đặt ra. Viết được báo cáo theo đúng mẫu và đầy đủ yêu cầu của Đồ án chuyên ngành công nghệ phần mềm. Thuyết trình được báo cáo trước lớp và giảng viên chấm báo cáo. "
    },
         "": {
        "mã học phần": "",
        "số tín chỉ": "",
        "giảng viên": "",
        "mô tả": ""
    },
             "": {
        "mã học phần": "",
        "số tín chỉ": "",
        "giảng viên": "",
        "mô tả": ""
    },
         "": {
        "mã học phần": "",
        "số tín chỉ": "",
        "giảng viên": "",
        "mô tả": ""
    },
             "": {
        "mã học phần": "",
        "số tín chỉ": "",
        "giảng viên": "",
        "mô tả": ""
    },
         "": {
        "mã học phần": "",
        "số tín chỉ": "",
        "giảng viên": "",
        "mô tả": ""
    },
             "": {
        "mã học phần": "",
        "số tín chỉ": "",
        "giảng viên": "",
        "mô tả": ""
    },
         "": {
        "mã học phần": "",
        "số tín chỉ": "",
        "giảng viên": "",
        "mô tả": ""
    },
             "": {
        "mã học phần": "",
        "số tín chỉ": "",
        "giảng viên": "",
        "mô tả": ""
    },
         "": {
        "mã học phần": "",
        "số tín chỉ": "",
        "giảng viên": "",
        "mô tả": ""
    },
             "": {
        "mã học phần": "",
        "số tín chỉ": "",
        "giảng viên": "",
        "mô tả": ""
    },
         "": {
        "mã học phần": "",
        "số tín chỉ": "",
        "giảng viên": "",
        "mô tả": ""
    },
             "": {
        "mã học phần": "",
        "số tín chỉ": "",
        "giảng viên": "",
        "mô tả": ""
    },
         "": {
        "mã học phần": "",
        "số tín chỉ": "",
        "giảng viên": "",
        "mô tả": ""
    },
             "": {
        "mã học phần": "",
        "số tín chỉ": "",
        "giảng viên": "",
        "mô tả": ""
    },
         "": {
        "mã học phần": "",
        "số tín chỉ": "",
        "giảng viên": "",
        "mô tả": ""
    },
             "": {
        "mã học phần": "",
        "số tín chỉ": "",
        "giảng viên": "",
        "mô tả": ""
    },
         "": {
        "mã học phần": "",
        "số tín chỉ": "",
        "giảng viên": "",
        "mô tả": ""
    },
    
    

}
#7. sau khi có dữ liệu các môn học thì cần lớp xử lí các dữ liệu trên như lớp dưới đây 
class ActionTraCuuThongTinMonHoc(Action):
    def name(self) -> Text:
        return "action_tra_cuu_thong_tin_mon_hoc"

    def run(self, dispatcher: CollectingDispatcher,
            tracker: Tracker,
            domain: Dict[Text, Any]) -> List[Dict[Text, Any]]:

        ten_mon = tracker.get_slot("ten_mon_hoc")
        if ten_mon in MON_HOC_INFO:
            info = MON_HOC_INFO[ten_mon]
            reply = (
                f"📘 **{ten_mon}**\n"
                f"- Mã học phần: {info['mã học phần']}\n"
                f"- Số tín chỉ: {info['số tín chỉ']}\n"
                f"- Giảng viên: {info['giảng viên']}\n"
                f"- Mô tả: {info['mô tả']}"
            )
        else:
            reply = f"Xin lỗi, tôi không tìm thấy thông tin học phần **{ten_mon}**."

        dispatcher.utter_message(text=reply)
        return []
#8. Tiếp theo là bước cuối, sang rules và thêm ngữ cảnh cho chatbot hiểu thôithôi

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
